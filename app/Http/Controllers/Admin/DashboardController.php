<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request): View|Factory|Application
    {
        $totalItem = OrderItem::sum('quantity');

        return view('admin.dashboard', [
            'total_item' => $totalItem,
            'total_order' => Order::count(),
            'total_pending' => Order::where('status', 'pending')->count(),
            'total_return' => Order::where('is_return', true)->count(),
            'new_orders' => Order::with('orderItems')->withSum(
                'orderItems',
                'quantity'
            )->whereHas('orderItems')->where('status', 'pending')->orderBy('created_at', 'desc')->limit(5)->get(),
        ]);
    }

    public function order(): int
    {
        return Order::where('status', 'pending')->whereHas('orderItems')->count();
    }

    public function dashboardData(): \Illuminate\Http\JsonResponse
    {

        return response()->json();
    }
}
