<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sku;
use Illuminate\Http\Request;

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

    public function products(Request $request)
    {
        $categories = Category::select('name', 'id')->get();

        $merk = Product::select('name')->distinct()->get();
        return view('frontend.products', [
            'title' => 'List Product',
            'categories' => $categories,
            'merks' => $merk
        ]);
    }

    public function listProduct(Request $request)
    {
        $products = Sku::with(['images', 'product'])->when($request->category, function ($query, $category) {
            $query->whereHas('product', function ($query) use ($category) {
                $query->where('category_id', $category);
            });
        })->when($request->merk, function ($query) use ($request) {
            $query->whereHas('product', function ($query) use ($request) {
                $query->where('name', $request->merk);
            });
        })->when($request->search, function ($query) use ($request) {
            $query->whereHas('product', function ($query) use ($request) {
                $query->where('name', 'like', "%$request->search%");
            });
        })
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        return view('frontend.list-product', compact('products'));
    }

    public function checkout(Request $request)
    {
        return view('frontend.checkout', [
            'title' => 'Checkout'
        ]);
    }

    public function saveOrder(Request $request)
    {
        $order = Order::create([
            'data' => $request->buyerInfo,
            'items' => $request->orderDetails,
        ]);

        return [
            'status' => 'success',
        ];
    }
}
