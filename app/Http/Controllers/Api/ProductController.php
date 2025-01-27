<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SkuResource;
use App\Models\Sku;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sku = Sku::with('image')
            ->whereHas('image')
            ->when($request->name, function ($query, $name) {
                return $query->where("name", "like", "%" . $name . "%");
            })
            ->paginate(10);
        return SkuResource::collection($sku);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $sku = Sku::find($id)->load(['product', 'product.category', 'image']);
        $recomended = Sku::with('image')
            ->whereHas('image')
            ->where('id', '!=', $id)
            ->inRandomOrder()
            ->limit(5)
            ->get();
        return SkuResource::make($sku)->additional([
            'recomended' => SkuResource::collection($recomended)
        ]);
    }
}
