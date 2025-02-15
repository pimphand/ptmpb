<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderAdminResource;
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

    public function update(Request $request, Order $order): JsonResponse
    {
        foreach ($request->id as $key => $id) {
           $item =  $order->orderItems()->find($id);
           $item->price = $request->value[$key];
           $item->note = $request->note[$key];
           $item->quantity = $request->quantity[$key];
           $item->save();
        }
        $order->driver_id = $request->driver_id;
        $order->save();
        return response()->json([
            'success' => true,
            'message' => 'Order berhasil diperbarui'
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
        })->latest()
            ->paginate(10);

        return OrderAdminResource::collection($orders);
    }

    /**
     * Display the specified resource.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $order->update([
            'status' => $request->status,
        ]);

        return response()->json([
            'success' => true,
        ]);
    }

    public function show(Order $order): View|Factory|Application
    {
      $order->load('customer', 'user', 'orderItems.sku.product','driver');
      $drivers = User::whereHasRole('driver')->get();
      return view('admin.order_detail', compact('order', 'drivers'));
    }
}
