<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Sku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $order = Auth::user()->orders()
            ->when($request->id, function ($query, $id) {
                return $query->where('id', $id)->with('customer');
            })
            ->when($request->status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($request->product, function ($query, $product) {
                return $query->where('items', 'like', "%$product%");
            })->when($request->customer, function ($query, $customer) {
                return $query->whereHas('customer', function ($query) use ($customer) {
                    $query->where('name', 'like', "%$customer%")
                        ->orWhere('owner_address', 'like', "%$customer%")
                        ->orWhere('address', 'like', "%$customer%")
                        ->orWhere('phone', 'like', "%$customer%");
                });
            })->with('customer')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return OrderResource::collection($order);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customers,id',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:skus,id',
            'items.*.quantity' => 'required|integer',
        ], [
            'items.*.product_id.exists' => 'Produk tidak ditemukan',
            'items.*.quantity.integer' => 'Jumlah harus berupa angka',
            'items.*.quantity.required' => 'Jumlah harus diisi',
            'items.*.product_id.required' => 'Produk harus diisi',
            'customer_id.required' => 'Customer harus diisi',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'message' => $validate->errors(),
            ], 422);
        }

        $items = [];
        foreach ($request->items as $key => $value) {
            $sku = Sku::find($value['product_id']);
            $items[] = [
                'product_id' => $value['product_id'],
                'quantity' => $value['quantity'],
                'name' => $sku->name,
                'brand' => $sku->product->name,
                'category' => $sku->product->category->name,
                'image' => $sku->image->path ?? null,
                'package' => $sku->packaging,
            ];
        }

        Order::create([
            'customer_id' => $request->customer_id,
            'status' => 'pending',
            'items' => $items,
            'user_id' => Auth::id(),
        ]);

        return response()->json([
            'message' => 'Order created',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return OrderResource::make($order->load('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,process,success,cancel,done',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
            ], 422);
        }

        if (Auth::user()->id != $order->user_id) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        $order->update([
            'status' => $request->status,
        ]);

        return response()->json([
            'message' => 'Order updated',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
