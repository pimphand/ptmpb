<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogCategoryRequest;
use App\Http\Requests\UpdateBlogCategoryRequest;
use App\Http\Resources\BlogCategoryResource;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Contracts\View\View;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.blog_category', [
            'title' => 'Blog Category'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogCategoryRequest $request): \Illuminate\Http\JsonResponse
    {
        BlogCategory::create($request->validated());

        return response()->json([
            'message' => 'Data berhasil disimpan'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogCategoryRequest $request, BlogCategory $blogCategory)
    {
        $blogCategory->update($request->validated());

        return response()->json([
            'message' => 'Data berhasil diupdate'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Get all data
     */

    public function data(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $blogCategories = BlogCategory::where('name', 'like', '%' . request('q') . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return BlogCategoryResource::collection($blogCategories);
    }
}
