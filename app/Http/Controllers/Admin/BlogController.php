<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('admin.blog', [
            'title' => 'Blog'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('admin.blog_create', [
            'title' => 'Tambah Blog',
            'categories' => BlogCategory::all(),
            'blog' => []
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request): \Illuminate\Http\JsonResponse
    {
        $image = ImageManager::imagick()->read($request->file('image'));

        // Resize gambar dan simpan di images/blog/thumbnail
        $thumbnailPath = $request->file('image')->storeAs('images/blog/thumbnail', 'thumbnail_' . time() . '.jpg', 'public');
        $image->resize(410, 293, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->save(storage_path('app/public/' . $thumbnailPath));

        // Simpan gambar asli di images/blog
        $imagePath = $request->file('image')->storeAs('images/blog', 'image_' . time() . '.jpg', 'public');

        $data['user_id'] = auth()->id();
        $data['title'] = $request->name;
        $data['is_publish'] = true;
        $data['category_id'] = $request->category;
        $data['thumbnail'] = $thumbnailPath;
        $data['image'] = $imagePath;
        $data['content'] = $request->content;

        // Menyimpan data blog ke database
        Blog::create($data);

        return response()->json([
            'message' => 'Data berhasil disimpan'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog): Blog
    {
        return $blog;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('admin.blog_create', [
            'title' => 'Edit Blog',
            'categories' => BlogCategory::all(),
            'blog' => $blog
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['title'] = $request->name;
        $data['is_publish'] = true;
        $data['category_id'] = $request->category;
        if ($request->hasFile('image')) {
            // Delete old image
            Storage::delete($blog->thumbnail);
            $data['thumbnail'] = $request->file('image')->store('images/blog', 'public');
        }
        $blog->update($data);

        return response()->json([
            'message' => 'Data berhasil disimpan'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return response()->json([
            'message' => 'Data berhasil dihapus'
        ]);
    }

    /**
     * Get data for resource.
     */
    public function data(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $blogs = Blog::with('category')
            ->when($request->id, function ($query) use ($request) {
                $query->where('id', $request->id);
            })
            ->where('title', 'like', "%$request->search%")
            ->orWhere('content', 'like', "%$request->search%")
            ->orderBy('id', 'desc')->paginate(10);
        return BlogResource::collection($blogs);
    }
}
