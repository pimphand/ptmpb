<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\UploadedFile;
use App\Services\ImageUploadService;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;

class UploadImageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'image:upload {path : Path to directory or specific image file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload and process images from a directory or single file';

    protected ImageUploadService $imageService;

    public function __construct(ImageUploadService $imageService)
    {
        parent::__construct();
        $this->imageService = $imageService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $path = $this->argument('path');

        // Convert relative path to absolute path
        if (!str_starts_with($path, '/')) {
            $path = base_path($path);
        }

        if (!file_exists($path)) {
            $this->error("Path not found: {$path}");
            return 1;
        }

        if (is_file($path)) {
            $this->processSingleFile($path);
        } else {
            $this->processDirectory($path);
        }

        return 0;
    }

    /**
     * Process a single image file
     */
    protected function processSingleFile(string $filePath): void
    {
        try {
            $file = $this->createUploadedFileFromPath($filePath);

            if (!$file) {
                $this->error("Could not process file: {$filePath}");
                return;
            }

            // Extract directory structure from original path
            $directory = $this->extractDirectoryFromPath($filePath);

            $this->info("Processing file: " . basename($filePath));

            $result = $this->imageService->uploadImage($file, $directory);

            if ($result['success']) {
                $this->displaySuccessResult($result, basename($filePath));
            } else {
                $this->error("Failed to upload {$filePath}: " . $result['error']);
            }
        } catch (\Exception $e) {
            $this->error("Error processing {$filePath}: " . $e->getMessage());
        }
    }

    /**
     * Process all images in a directory
     */
    protected function processDirectory(string $directoryPath): void
    {
        $imageFiles = $this->findImageFiles($directoryPath);

        if (empty($imageFiles)) {
            $this->info('No image files found in the specified directory.');
            return;
        }

        $this->info("Found " . count($imageFiles) . " image files");

        $progressBar = $this->output->createProgressBar(count($imageFiles));
        $progressBar->start();

        $results = [
            'success' => 0,
            'failed' => 0,
            'skipped' => 0,
            'errors' => []
        ];

        foreach ($imageFiles as $filePath) {
            try {
                $file = $this->createUploadedFileFromPath($filePath);

                if (!$file) {
                    $results['failed']++;
                    $results['errors'][] = "Could not create UploadedFile for: " . basename($filePath);
                    $progressBar->advance();
                    continue;
                }

                // Extract directory structure from original path
                $directory = $this->extractDirectoryFromPath($filePath);

                $result = $this->imageService->uploadImage($file, $directory);

                if ($result['success']) {
                    $results['success']++;
                    if (isset($result['skipped_conversion']) && $result['skipped_conversion']) {
                        $results['skipped']++;
                    }
                } else {
                    $results['failed']++;
                    $results['errors'][] = basename($filePath) . ': ' . $result['error'];
                }
            } catch (\Exception $e) {
                $results['failed']++;
                $results['errors'][] = basename($filePath) . ': ' . $e->getMessage();
            }

            $progressBar->advance();
        }

        $progressBar->finish();
        $this->newLine(2);

        $this->displaySummary($results);
    }

    /**
     * Find all image files in directory recursively
     */
    protected function findImageFiles(string $directory): array
    {
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'];
        $files = [];

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($directory, \RecursiveDirectoryIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            if ($file->isFile()) {
                $extension = strtolower($file->getExtension());
                if (in_array($extension, $imageExtensions)) {
                    $files[] = $file->getPathname();
                }
            }
        }

        return $files;
    }

    /**
     * Create UploadedFile from file path
     */
    protected function createUploadedFileFromPath(string $filePath): ?UploadedFile
    {
        if (!file_exists($filePath) || !is_readable($filePath)) {
            return null;
        }

        $file = new File($filePath);
        $originalName = $file->getFilename();
        $mimeType = $file->getMimeType();
        $size = $file->getSize();

        // Create a temporary file to simulate uploaded file
        $tempFile = tempnam(sys_get_temp_dir(), 'upload_');
        copy($filePath, $tempFile);

        return new UploadedFile(
            $tempFile,
            $originalName,
            $mimeType,
            null,
            true // Mark as test file to avoid validation errors
        );
    }

    /**
     * Extract directory structure from file path
     * e.g., /path/to/storage/app/public/galleries/image.jpg -> galleries
     */
    protected function extractDirectoryFromPath(string $filePath): string
    {
        // Get the directory part
        $directory = dirname($filePath);

        // Find common patterns to extract the relevant directory
        $patterns = [
            '/storage\/app\/public\/(.+)$/',
            '/public\/(.+)$/',
            '/uploads\/(.+)$/',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $directory, $matches)) {
                return $matches[1];
            }
        }

        // If no pattern matches, try to find a reasonable directory name
        $pathParts = explode('/', $directory);
        $relevantParts = [];
        $foundPublic = false;

        foreach ($pathParts as $part) {
            if ($foundPublic && !empty($part)) {
                $relevantParts[] = $part;
            }
            if (in_array($part, ['public', 'storage', 'uploads'])) {
                $foundPublic = true;
                $relevantParts = []; // Reset to start collecting after public/storage
            }
        }

        return implode('/', $relevantParts);
    }

    /**
     * Display success result for single file
     */
    protected function displaySuccessResult(array $result, string $filename): void
    {
        $this->info("✓ Successfully uploaded: {$filename}");
        $this->line("  File: {$result['file_name']}");
        $this->line("  Path: {$result['file_path']}");
        $this->line("  Size: " . $this->formatBytes($result['size']));
        $this->line("  Type: {$result['mime_type']}");

        if (isset($result['skipped_conversion']) && $result['skipped_conversion']) {
            $this->line("  <comment>GIF conversion skipped (preserving animation)</comment>");
        }

        $this->newLine();
    }

    /**
     * Display processing summary
     */
    protected function displaySummary(array $results): void
    {
        $this->info('Upload Summary:');
        $this->line("  ✓ Successful: {$results['success']}");
        $this->line("  ✗ Failed: {$results['failed']}");

        if ($results['skipped'] > 0) {
            $this->line("  ⚠ GIF files (preserved): {$results['skipped']}");
        }

        if (!empty($results['errors'])) {
            $this->newLine();
            $this->error('Errors encountered:');
            foreach ($results['errors'] as $error) {
                $this->line("  • {$error}");
            }
        }
    }

    /**
     * Format bytes to human readable format
     */
    protected function formatBytes(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= (1 << (10 * $pow));

        return round($bytes, 2) . ' ' . $units[$pow];
    }
}
