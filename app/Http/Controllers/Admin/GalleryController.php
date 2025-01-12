<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Models\Gallery;
use App\Models\Image;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('admin.gallery.index', [
            'title' => 'Galeri'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gallery.create', [
            'title' => 'Galeri',
            'gallery' => []
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGalleryRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $gallery = Gallery::create([
                'title' => $request->title,
                'description' => $request->description,
                'url' => $request->url,
                'is_publish' => $request->is_publish
            ]);

            Image::create([
                'path' => $request->file('image')->store('galleries', 'public'),
                'imaginable_id' => $gallery->id,
                'imaginable_type' => $gallery->getMorphClass()
            ]);

            return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil ditambahkan');
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        //
    }
}
