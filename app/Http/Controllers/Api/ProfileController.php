<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $order = Order::where('user_id', Auth::user()->id)
            ->whereIn('orders.status', ['success', 'done']) // Menyebutkan tabel dengan eksplisit
            ->whereBetween('orders.created_at', [now()->startOfYear(), now()->endOfYear()])
            ->leftJoin('order_items', 'orders.id', '=', 'order_items.order_id')
            ->selectRaw('orders.status, COALESCE(SUM(order_items.quantity * order_items.price), 0) as total')
            ->selectRaw('orders.status, COALESCE(SUM(order_items.quantity), 0) as total_items')
            ->groupBy('orders.status')
            ->first();

        $status = Order::where('user_id', Auth::user()->id)
            ->whereBetween('orders.created_at', [now()->startOfYear(), now()->endOfYear()])
            ->selectRaw('orders.status, COUNT(orders.id) as total')
            ->whereHas('orderItems')
            ->groupBy('orders.status')
            ->get()
            ->map(function ($order) {
                if ($order->status === 'done') {
                    $order->status = 'success';
                }
                return $order;
            });
        return [
            'data' => [
                'user' => Auth::user(),
                'order' => $order,
                'status' => $status,
            ]
        ];
    }


    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'confirmed',
            'address' => 'required',
            'photo' => 'nullable|image'
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->address = $request->address;
        if ($request->hasFile('photo')) {
            $user->photo = asset('storage') . "/" . $request->file('photo')->store('photos', 'public');
        }
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return [
            'data' => $user
        ];
    }
}
