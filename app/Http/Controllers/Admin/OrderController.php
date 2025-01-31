<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderAdminResource;
use App\Http\Resources\OrderResource;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.order', [
            'title' => 'Order'
        ]);
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update([
            'is_folow_up' => 1
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function data(Request $request)
    {
        $orders = Order::when($request->search, function ($query) use ($request) {
            $query->where('items', 'like', "%{$request->search}%")
                ->orWhere('data', 'like', "%{$request->search}%");
        })
            ->latest()
            ->paginate(10);
        return OrderAdminResource::collection($orders);
    }

    /**
     * Display the specified resource.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $order->update([
            'status' => $request->status
        ]);

        return response()->json([
            'success' => true
        ]);
    }
}
