<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderAdminResource;
use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.order', [
            'title' => 'Order',
        ]);
    }

    public function create(): View|Factory|Application
    {
        return view('admin.order_create', [
            'title' => 'Order',
            'sales' => User::whereHasRole('sales')->get(),
            'drivers' => User::whereHasRole('driver')->get(),
            'collectors' => User::whereHasRole('debt-collector')->get(),
        ]);
    }

    public function update(Request $request, Order $order): JsonResponse
    {
        $total = 0;
        foreach ($request->id as $key => $id) {
            $item = $order->orderItems()->find($id);
            $item->price = $request->value[$key];
            $item->note = $request->note[$key];
            $item->quantity = $request->quantity[$key];
            $item->save();

            $total += $item->price * $item->quantity;
        }

        if ($order->status == 'pending') {
            $order->status = 'process';
        }

        $order->date_delivery = $request->delivery_date;
        $order->type_discount = $request->type_discount ?? null;
        $order->discount = $request->type_discount ? $request->discount * ($request->discount / 100) : $request->discount;
        $order->collector_id = $request->collector_id;
        if (!$order->driver_id){
            $order->payments()->create([
                'method' => "System",
                'date' => now(),
                'amount' => 0,
                'remaining' => $total,
                'customer' => $order->customer->store_name,
                'collector' => "System",
                'admin' => "System",
            ]);
        }
        $order->driver_id = $request->driver_id;
        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Order berhasil diperbarui',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function data(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $orders = Order::when($request->search, function ($query) use ($request) {
            $query->where('items', 'like', "%{$request->search}%")
                ->orWhere('data', 'like', "%{$request->search}%");
        })
            ->when($request->status, function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->user_id, function ($query) use ($request) {
                $query->where('user_id', $request->user_id);
            })->when($request->customer_id, function ($query) use ($request) {
                $query->where('customer_id', $request->customer_id);
            })
            ->with('payment')
            ->whereHas('orderItems')
            ->latest()
            ->paginate(10);

        return OrderAdminResource::collection($orders);
    }

    /**
     * Display the specified resource.
     */
    public function updateStatus(Request $request, Order $order): JsonResponse
    {
        $order->update([
            'status' => $request->status,
        ]);

        return response()->json([
            'success' => true,
        ]);
    }

    public function show(Order $order) // : View|Factory|Application
    {
        $order->load('customer', 'user', 'orderItems.sku.product', 'driver');

        $drivers = User::whereHasRole('driver')->get();
        $collectors = User::whereHasRole('debt-collector')->get();
        return view('admin.order_detail', compact('order', 'drivers','collectors'));
    }

    public function customer(Request $request, $id)
    {
        return Customer::where('user_id', $id)
            ->where(function ($query) use ($request) {
                $query->where('name', 'like', "%$request->search%")
                    ->orWhere('store_name', 'like', "%$request->search%");
            })
            ->get();
    }
}
