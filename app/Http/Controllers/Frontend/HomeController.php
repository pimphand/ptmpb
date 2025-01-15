<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Imports\ProductImport;
use App\Models\About;
use App\Models\Blog;
use App\Models\Sku;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    /**
     * Display the homepage.
     */
    public function about_us(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $data = [
            'title' => 'Tentang Kami',
            'about' => About::first()
        ];
        return view('frontend.about_us', $data);
    }

    public function blog($id): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $blog = Blog::whereSlug($id)->firstOrFail();

        // Check if the user has already visited this blog recently
        $lastViewed = session("blog_{$id}_viewed");

        if (!$lastViewed || now()->diffInMinutes($lastViewed) > 1) {
            // Set not spam and increment views
            $blog->count += 1;
            $blog->save();
            // Store the current time in session to prevent spamming
            session(["blog_{$id}_viewed" => now()]);
        }

        return view('frontend.blog.detail', [
            'title' => 'Blog',
            'blog' => $blog
        ]);
    }

    public function blogs(Request $request): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $blogs = Blog::whereLike('title', "%$request->search%")
            ->orWhere('content', 'like', "%$request->search%")
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        return view('frontend.blog.list', [
            'title' => 'List Blog',
            'blogs' => $blogs
        ]);
    }

    public function upload(Request $request)
    {
//        Excel::import(new ProductImport(), $request->file);
    }

    public function productData(Request $request)
    {
        $skus = Sku::when($request->category, function ($query, $category) {
            return $query->whereHas('product', function ($query) use ($category) {
                $query->where('category_id', $category);
            });
        })->when($request->search, function ($query, $search) {
            return $query->where('name', 'like', "%$search%");
        })->with('product.category')
            ->orderBy('created_at', 'desc')
            ->paginate($request->length ?? 10);

        return ProductResource::collection($skus);
    }
}
