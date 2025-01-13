<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Blog;
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

    public function blogs(Request $request)
    {
        $blogs = Blog::whereAny([
            'title' => $request->get('search'),
            'content' => $request->get('search')
        ])
            ->orderBy('count', 'desc')
            ->paginate(6);

        return view('frontend.blog.list', [
            'title' => 'List Blog',
            'blogs' => $blogs
        ]);
    }
}
