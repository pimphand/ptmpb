<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Exception;

class ImageUploadService
{
    protected $disk;
    protected array $allowedMimes = [
        'image/jpeg',
        'image/jpg',
        'image/png',
        'image/gif',
        'image/webp',
        'image/bmp'
    ];
    protected int $maxSize = 10 * 1024 * 1024; // 10MB
    protected int $maxWidth = 1920;
    protected int $maxHeight = 1080;
    protected int $webpQuality = 80;

    public function __construct()
    {
        $this->disk = Storage::disk('r2');
    }

    /**
     * Upload dan konversi gambar ke WebP.
     *
     * @param UploadedFile $file
     * @param string $directory
     * @param array $options
     * @return array
     */
    public function uploadImage(UploadedFile $file, string $directory = 'images', array $options = []): array
    {
        try {
            // Merge options with defaults
            $options = array_merge([
                'resize' => true,
                'quality' => $this->webpQuality,
                'max_width' => $this->maxWidth,
                'max_height' => $this->maxHeight,
                'preserve_original_format' => false
            ], $options);

            $this->validateImage($file);

            $fileName = $this->generateFileName($file, $options['preserve_original_format']);
            $filePath = trim($directory, '/') . '/' . $fileName;

            $processedImage = $this->processImage($file, $options);

            $uploaded = $this->disk->put($filePath, $processedImage);

            if (!$uploaded) {
                throw new Exception('Gagal mengunggah gambar ke R2 storage.');
            }

            Log::info('Image uploaded successfully', [
                'file_name' => $fileName,
                'file_path' => $filePath,
                'original_size' => $file->getSize(),
                'processed_size' => strlen($processedImage)
            ]);

            return [
                'success' => true,
                'file_name' => $fileName,
                'file_path' => $filePath,
                'url' => $this->getImageUrl($filePath),
                'size' => strlen($processedImage),
                'original_size' => $file->getSize(),
                'mime_type' => $options['preserve_original_format'] ? $file->getMimeType() : 'image/webp'
            ];
        } catch (Exception $e) {
            Log::error('Image upload failed', [
                'error' => $e->getMessage(),
                'file_name' => $file->getClientOriginalName() ?? 'unknown',
                'file_size' => $file->getSize() ?? 0
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Upload beberapa gambar sekaligus dengan batch processing.
     */
    public function uploadMultipleImages(array $files, string $directory = 'images', array $options = []): array
    {
        $results = [];
        $successCount = 0;
        $failCount = 0;

        foreach ($files as $index => $file) {
            if (!($file instanceof UploadedFile)) {
                $results[] = [
                    'success' => false,
                    'error' => 'File pada index ' . $index . ' bukan instance UploadedFile yang valid.',
                    'index' => $index
                ];
                $failCount++;
                continue;
            }

            $result = $this->uploadImage($file, $directory, $options);
            $result['index'] = $index;
            $results[] = $result;

            if ($result['success']) {
                $successCount++;
            } else {
                $failCount++;
            }
        }

        return [
            'results' => $results,
            'summary' => [
                'total' => count($files),
                'success' => $successCount,
                'failed' => $failCount
            ]
        ];
    }

    /**
     * Validasi file gambar dengan pengecekan yang lebih ketat.
     */
    protected function validateImage(UploadedFile $file): void
    {
        // Cek apakah file valid
        if (!$file->isValid()) {
            throw new Exception('File yang diunggah tidak valid atau rusak.');
        }

        // Cek MIME type
        if (!in_array($file->getMimeType(), $this->allowedMimes, true)) {
            throw new Exception(
                'Tipe file tidak didukung. Hanya ' .
                    implode(', ', array_map(fn($mime) => str_replace('image/', '', $mime), $this->allowedMimes)) .
                    ' yang diperbolehkan.'
            );
        }

        // Cek ukuran file
        if ($file->getSize() > $this->maxSize) {
            $maxSizeMB = $this->maxSize / (1024 * 1024);
            throw new Exception("Ukuran file terlalu besar. Maksimal {$maxSizeMB}MB.");
        }

        // Cek apakah benar-benar file gambar
        try {
            $imageInfo = getimagesize($file->getRealPath());
            if ($imageInfo === false) {
                throw new Exception('File bukan gambar yang valid.');
            }
        } catch (Exception $e) {
            throw new Exception('Gagal memvalidasi file gambar: ' . $e->getMessage());
        }
    }

    /**
     * Generate nama file unik dengan format yang lebih baik.
     */
    protected function generateFileName(UploadedFile $file, bool $preserveFormat = false): string
    {
        $timestamp = now()->format('YmdHis');
        $random = Str::random(12);
        $extension = $preserveFormat ? $file->getClientOriginalExtension() : 'webp';

        return "{$timestamp}_{$random}.{$extension}";
    }

    /**
     * Process gambar menggunakan GD library native PHP.
     */
    protected function processImage(UploadedFile $file, array $options): string
    {
        try {
            $imagePath = $file->getRealPath();
            $imageInfo = getimagesize($imagePath);

            if (!$imageInfo) {
                throw new Exception('Tidak dapat membaca informasi gambar.');
            }

            // Buat resource gambar berdasarkan tipe
            $sourceImage = $this->createImageResource($imagePath, $imageInfo[2]);

            if (!$sourceImage) {
                throw new Exception('Gagal membuat resource gambar.');
            }

            $originalWidth = imagesx($sourceImage);
            $originalHeight = imagesy($sourceImage);

            // Hitung dimensi baru jika perlu resize
            $newWidth = $originalWidth;
            $newHeight = $originalHeight;

            if ($options['resize'] && ($originalWidth > $options['max_width'] || $originalHeight > $options['max_height'])) {
                $ratio = min($options['max_width'] / $originalWidth, $options['max_height'] / $originalHeight);
                $newWidth = (int)($originalWidth * $ratio);
                $newHeight = (int)($originalHeight * $ratio);
            }

            // Buat gambar baru dengan dimensi yang sesuai
            $newImage = imagecreatetruecolor($newWidth, $newHeight);

            // Preserve transparency untuk PNG dan GIF
            if ($imageInfo[2] == IMAGETYPE_PNG || $imageInfo[2] == IMAGETYPE_GIF) {
                imagealphablending($newImage, false);
                imagesavealpha($newImage, true);
                $transparent = imagecolorallocatealpha($newImage, 0, 0, 0, 127);
                imagefill($newImage, 0, 0, $transparent);
            }

            // Resize gambar
            imagecopyresampled($newImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);

            // Encode ke format yang diinginkan
            ob_start();

            if ($options['preserve_original_format']) {
                $this->outputOriginalFormat($newImage, $imageInfo[2], $options['quality']);
            } else {
                // Convert ke WebP
                if (function_exists('imagewebp')) {
                    imagewebp($newImage, null, $options['quality']);
                } else {
                    // Fallback ke JPEG jika WebP tidak tersedia
                    imagejpeg($newImage, null, $options['quality']);
                }
            }

            $imageData = ob_get_contents();
            ob_end_clean();

            // Cleanup
            imagedestroy($sourceImage);
            imagedestroy($newImage);

            return $imageData;
        } catch (Exception $e) {
            throw new Exception('Gagal memproses gambar: ' . $e->getMessage());
        }
    }

    /**
     * Buat resource gambar berdasarkan tipe file.
     */
    protected function createImageResource(string $imagePath, int $imageType)
    {
        switch ($imageType) {
            case IMAGETYPE_JPEG:
                return imagecreatefromjpeg($imagePath);
            case IMAGETYPE_PNG:
                return imagecreatefrompng($imagePath);
            case IMAGETYPE_GIF:
                return imagecreatefromgif($imagePath);
            case IMAGETYPE_WEBP:
                return function_exists('imagecreatefromwebp') ? imagecreatefromwebp($imagePath) : false;
            case IMAGETYPE_BMP:
                return function_exists('imagecreatefrombmp') ? imagecreatefrombmp($imagePath) : false;
            default:
                return false;
        }
    }

    /**
     * Output gambar dalam format original.
     */
    protected function outputOriginalFormat($image, int $imageType, int $quality): void
    {
        switch ($imageType) {
            case IMAGETYPE_JPEG:
                imagejpeg($image, null, $quality);
                break;
            case IMAGETYPE_PNG:
                // PNG quality range is 0-9
                $pngQuality = (int)(9 - ($quality / 100) * 9);
                imagepng($image, null, $pngQuality);
                break;
            case IMAGETYPE_GIF:
                imagegif($image);
                break;
            case IMAGETYPE_WEBP:
                if (function_exists('imagewebp')) {
                    imagewebp($image, null, $quality);
                } else {
                    imagejpeg($image, null, $quality);
                }
                break;
            default:
                imagejpeg($image, null, $quality);
                break;
        }
    }

    /**
     * Hapus file dari R2 dengan error handling.
     */
    public function deleteImage(string $filePath): bool
    {
        try {
            if (!$this->disk->exists($filePath)) {
                Log::warning('Attempted to delete non-existent file', ['file_path' => $filePath]);
                return false;
            }

            $deleted = $this->disk->delete($filePath);

            if ($deleted) {
                Log::info('Image deleted successfully', ['file_path' => $filePath]);
            } else {
                Log::error('Failed to delete image', ['file_path' => $filePath]);
            }

            return $deleted;
        } catch (Exception $e) {
            Log::error('Error deleting image', [
                'file_path' => $filePath,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Hapus beberapa file sekaligus.
     */
    public function deleteMultipleImages(array $filePaths): array
    {
        $results = [];
        $successCount = 0;
        $failCount = 0;

        foreach ($filePaths as $filePath) {
            $deleted = $this->deleteImage($filePath);
            $results[] = [
                'file_path' => $filePath,
                'success' => $deleted
            ];

            if ($deleted) {
                $successCount++;
            } else {
                $failCount++;
            }
        }

        return [
            'results' => $results,
            'summary' => [
                'total' => count($filePaths),
                'success' => $successCount,
                'failed' => $failCount
            ]
        ];
    }

    /**
     * Dapatkan URL publik dari gambar.
     */
    public function getImageUrl(string $filePath): string
    {
        return $this->disk->url($filePath);
    }

    /**
     * Cek apakah file exists di storage.
     */
    public function imageExists(string $filePath): bool
    {
        return $this->disk->exists($filePath);
    }

    /**
     * Get image metadata.
     */
    public function getImageMetadata(string $filePath): ?array
    {
        try {
            if (!$this->disk->exists($filePath)) {
                return null;
            }

            $size = $this->disk->size($filePath);
            $lastModified = $this->disk->lastModified($filePath);

            return [
                'file_path' => $filePath,
                'size' => $size,
                'url' => $this->getImageUrl($filePath),
                'last_modified' => date('Y-m-d H:i:s', $lastModified)
            ];
        } catch (Exception $e) {
            Log::error('Error getting image metadata', [
                'file_path' => $filePath,
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }

    /**
     * Set configuration options.
     */
    public function setConfig(array $config): self
    {
        if (isset($config['max_size'])) {
            $this->maxSize = $config['max_size'];
        }
        if (isset($config['max_width'])) {
            $this->maxWidth = $config['max_width'];
        }
        if (isset($config['max_height'])) {
            $this->maxHeight = $config['max_height'];
        }
        if (isset($config['webp_quality'])) {
            $this->webpQuality = $config['webp_quality'];
        }
        if (isset($config['allowed_mimes'])) {
            $this->allowedMimes = $config['allowed_mimes'];
        }

        return $this;
    }
}
