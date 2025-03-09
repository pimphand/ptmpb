<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request): View|Factory|Application
    {
        $totalItem = OrderItem::sum('quantity');
        $sales = User::whereHas('roles', function ($query) {
            $query->where('name', 'sales');
        })
            ->withCount(['orders as success_orders_count' => function ($query) {
                $query->where('status', 'success');
            }])
            ->withSum('payments', 'amount') // Perbaikan withSum
            ->whereHas('orders.orderItems')
            ->orderByDesc('success_orders_count') // Bisa juga pakai 'payments_sum_amount' jika ingin berdasarkan total pembayaran
            ->limit(5)
            ->get();

        $paid = Payment::sum('amount');
        return view('admin.dashboard', [
            'total_item' => $totalItem,
            'total_order' => Order::count(),
            'total_pending' => Order::whereHas('orderItems')->where('status', 'pending')->count(),
            'omzet' => OrderItem::whereHas('order', fn ($query) => $query->where('status', 'success')
            )->sum(DB::raw('price * quantity')),
            'new_orders' => Order::with('orderItems')->withSum(
                'orderItems',
                'quantity'
            )->whereHas('orderItems')->where('status', 'pending')->orderBy('created_at', 'desc')->limit(5)->get(),
            'sales' => $sales,
            'paid' => $paid,
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
