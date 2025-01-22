<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Http\Resources\GalleryResource;
use App\Models\Gallery;
use App\Models\Image;
use Illuminate\Http\Request;
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
                'is_publish' => $request->is_publish ?? false,
                'type' => $request->type
            ]);

            foreach ($request->image as $image) {
                Image::create([
                    'path' => $image->store('galleries', 'public'),
                    'imaginable_id' => $gallery->id,
                    'imaginable_type' => $gallery->getMorphClass(),
                    'gallery_type' => $request->type
                ]);
            }

            return response()->json([
                'message' => 'Data berhasil disimpan'
            ]);
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
        return view('admin.gallery.create', [
            'title' => 'Galeri',
            'gallery' => $gallery
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        return DB::transaction(function () use ($request, $gallery) {
            $gallery->update([
                'title' => $request->title,
                'description' => $request->description,
                'url' => $request->url,
                'is_publish' => $request->is_publish ?? false,
                'type' => $request->type
            ]);

            if ($request->hasFile('image')) {
                foreach ($request->image as $image) {
                    Image::create([
                        'imaginable_id' => $gallery->id,
                        'imaginable_type' => $gallery->getMorphClass(),
                        'path' => $image->store('galleries', 'public'),
                    ]);
                }
            }

            return response()->json([
                'message' => 'Data berhasil diubah'
            ]);
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery): \Illuminate\Http\JsonResponse
    {
        $gallery->delete();
        return response()->json([
            'message' => 'Data berhasil dihapus'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id): \Illuminate\Http\JsonResponse
    {
        $image = Image::find($id);
        $image->delete();
        return response()->json([
            'message' => 'Data berhasil dihapus',
            'redirect' => false
        ]);
    }

    /*
     * get all galleries
     */
    public function data(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $galleries = Gallery::with('images')->paginate(10);
        return GalleryResource::collection($galleries);
    }
}
