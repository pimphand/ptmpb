<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Sku;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $order = Order::query();
        if (Auth::user()->roles()->first()->name == 'driver') {
            $order->where('driver_id', Auth::id());
        } elseif (Auth::user()->roles()->first()->name == 'debt-collector') {
            $order->where('collector_id', Auth::id());
        } else {
            $order->where('user_id', Auth::id());
        }

        $order->when($request->id, function ($query, $id) {
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
            })->with(['customer', 'driver', 'orderItems.sku.product','payments'])
            ->whereHas('orderItems')
            ->orderBy('updated_at', 'desc');
        $data = $order->paginate(10);

        return OrderResource::collection($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
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

        return DB::transaction(function () use ($request) {
            $order = Order::create([
                'customer_id' => $request->customer_id,
                'status' => 'pending',
                'discount' => $request->discount ?? 0,
                'user_id' => $request->sales_id ?? Auth::id(),
            ]);
            $total = 0;
            foreach ($request->items as $key => $value) {
                $sku = Sku::find($value['product_id']);
                OrderItem::create([
                    'quantity' => $value['quantity'],
                    'sku_id' => $sku->id,
                    'price' => $value['price'] ?? 0,
                    'total' => $value['quantity'] * ($value['price'] ?? 0),
                    'order_id' => $order->id,
                ]);

                $items[] = [
                    'product_id' => $value['product_id'],
                    'quantity' => $value['quantity'],
                    'name' => $sku->name,
                    'brand' => $sku->product->name,
                    'category' => $sku->product->category->name,
                    'image' => $sku->image->path ?? null,
                    'package' => $sku->packaging,
                ];

                $sku->total_order += $value['quantity'];
                $sku->save();

                $total += $value['quantity'] * ($value['price'] ?? 0);
            }

            $order->payments()->create([
                'method' => "System",
                'date' => now(),
                'amount' => 0,
                'remaining' => $total,
                'customer' => $order->customer->store_name,
                'collector' => "System",
                'admin' => "System",
            ]);

            $order->items = $items;
            $order->save();

            return response()->json([
                'message' => 'Order created',
            ]);
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order): OrderResource
    {
        return OrderResource::make($order->load('customer', 'user', 'orderItems.sku.product', 'driver'));
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
        return DB::transaction(function () use ($request, $order) {
            $total = 0;
            foreach ($request->id as $key => $sku) {
                $item = $order->orderItems()->where('id', $sku)->first();
                if ($request->quantity[$key] > 0) {
                    if ($item) {
                        $item->update([
                            'returns' => $request->quantity[$key],
                        ]);
                    }
                }
                $total += $item->quantity * $item->price;
            }

            $user = $order->user()->first();
            $user->achieved_sales += $total;
            $user->save();

            if ($request->status == 'retur') {
                $order->status = 'process';
                $order->is_return = true;
            } else {
                $order->status = 'success';
                $order->tanggal_pengiriman = now();
            }

            $order->note = $request->note ?? $order->note;
            $order->file = $request->file ?? $order->file;
            $order->bukti_pengiriman = $request->file ?? $order->file;
            $order->save();

            return response()->json([
                'message' => 'Order updated',
                'request' => $request->all(),
            ]);
        });
    }

    /**
     * save order payment
     */
    public function payment(Request $request, Order $order)//: \Illuminate\Http\JsonResponse
    {
        return DB::transaction(function () use ($request, $order) {
            $order->payments()->create([
                'method' => $request->method,
                'date' => Carbon::parse($request->date)->toDateString() . ' ' . now()->toTimeString(),
                'amount' => $request->amount,
                'remaining' => $order->payment()->first()->remaining - $request->amount,
                'customer' => $order->customer->name,
                'collector' => Auth::user()->name,
                'user_id' => $order->user_id,
                'customer_id' => $order->customer_id,
            ]);

            if ($request->paid) {
                $order->paid = $request->paid;
                $order->status = 'success';
                $order->save();
            }

            return response()->json([
                'message' => 'Payment created',
            ]);
        });
    }
}
