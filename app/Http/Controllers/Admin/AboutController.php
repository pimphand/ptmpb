<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAboutRequest;
use App\Http\Requests\UpdateAboutRequest;
use App\Models\About;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Factory|Application
    {
        return view('admin.about', [
            'title' => 'About',
            'about' => About::first()
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
    public function store(StoreAboutRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = [
            'npwp' => $request->npwp,
            'kumham_decree' => $request->kumham_decree,
            'deed_of_establishment' => $request->deed_of_establishment,
            'nib' => $request->nib,
            'profile' => $request->hasFile('profile') ? $request->file('profile')->store('images/about', 'public') : '',
        ];
        About::create(array_merge($request->validated(), ['data' => $data]));

        return response()->json([
            'message' => 'Data berhasil disimpan'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(About $about)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAboutRequest $request, $id ): array
    {
        $about = About::find($id);
        $data = [
            'npwp' => $request->npwp,
            'kumham_decree' => $request->kumham_decree,
            'deed_of_establishment' => $request->deed_of_establishment,
            'nib' => $request->nib,
            'profile' => $request->hasFile('profile') ? $request->file('profile')->store('images/about', 'public') : $about->data['profile'],
        ];

        $about->update(array_merge($request->validated(), ['data' => $data]));

        return [
            'message' => 'Data berhasil diupdate'
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(About $about)
    {
        //
    }
}
