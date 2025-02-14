<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SkuResource;
use App\Models\Order;
use App\Models\Sku;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->sync == 1) {
            $orders = Order::all();
            foreach ($orders as $key => $order) {
                foreach ($order->items as $key => $item) {

                    $sku = Sku::find($item['product_id']);

                    if ($sku) {
                        $sku->total_order += $item['quantity'];
                        $sku->save();
                    }

                }
            }
        }

        $sku = Sku::with('image')
            ->whereHas('image')
            ->when($request->name, function ($query, $name) {
                return $query->where('name', 'like', '%'.$name.'%');
            })
            ->orderBy('total_order', 'desc')
            ->paginate(12);

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
            'recomended' => SkuResource::collection($recomended),
        ]);
    }
}
