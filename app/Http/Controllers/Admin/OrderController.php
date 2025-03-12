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
        ]);
    }

    public function update(Request $request, Order $order): JsonResponse
    {
        foreach ($request->id as $key => $id) {
            $item = $order->orderItems()->find($id);
            $item->price = $request->value[$key];
            $item->note = $request->note[$key];
            $item->quantity = $request->quantity[$key];
            $item->save();
        }

        if ($order->status == 'pending') {
            $order->status = 'process';
        }
        $order->driver_id = $request->driver_id;
        $order->date_delivery = $request->delivery_date;
        $order->type_discount = $request->type_discount ?? null;
        $order->discount = $request->type_discount ? $request->discount * ($request->discount / 100) : $request->discount;
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

        return view('admin.order_detail', compact('order', 'drivers'));
    }

    public function customer($id)
    {
        return Customer::where('user_id', $id)->get();
    }
}
