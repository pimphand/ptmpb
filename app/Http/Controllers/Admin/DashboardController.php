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
        $totalItem = OrderItem::whereHas('order', function ($query) {
            $query->where('status', 'success');
        })->sum('quantity');

        $sales = User::whereHas('roles', function ($query) {
            $query->where('name', 'sales');
        })
            ->withCount(['orders as success_orders_count' => function ($query) {
                $query->where('status', 'success');
            }])

            ->withSum('payments', 'amount')
            ->whereHas('orders', function ($query) {
                $query->where('status', 'success');
            })
            ->orderByDesc('success_orders_count')
            ->limit(5)
            ->get();

        $paid = Payment::whereHas('order', fn ($query) => $query->where('status', 'success')->whereHas('user', function ($query) {
            $query->whereNull('deleted_at'); // Ensure the user is not soft deleted
        })
        )->sum('amount');

        return view('admin.dashboard', [
            'total_item' => $totalItem,
            'total_order' => Order::whereHas('user', function ($query) {
                $query->whereNull('deleted_at'); // Ensure the user is not soft deleted
            })->count(),
            'total_pending' => Order::whereHas('user', function ($query) {
                $query->whereNull('deleted_at'); // Ensure the user is not soft deleted
            })->whereHas('orderItems')->where('status', 'pending')->count(),
            'omzet' => OrderItem::whereHas('order', fn ($query) => $query->where('status', 'success')->whereHas('user', function ($query) {
                $query->whereNull('deleted_at'); // Ensure the user is not soft deleted
            })
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

    public function report(Request $request)
    {
        return view('admin.report');
    }

    public function reportData(Request $request): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'today' => $this->reportToday($request),
            'week' => $this->reportWeek($request),
            'month' => $this->reportMonth($request),
            'sales' => [
                'today' => $this->reportSales($request, 'today'),
                'week' => $this->reportSales($request, 'week'),
                'month' => $this->reportSales($request, 'month'),
            ]
        ]);
    }

    private function generateReport(Request $request, $dateQuery): array
    {
        $totalOrders = Order::where($dateQuery)
            ->whereHas('orderItems')
            ->with(['orderItems' => function ($query) {
                $query->selectRaw('order_id, SUM(price * quantity) as total_amount')
                    ->groupBy('order_id');
            }])
            ->get();

        $categories = [];
        $statuses = ['pending', 'process', 'success', 'cancel'];
        $statusData = array_fill_keys($statuses, []);
        $statusSum = array_fill_keys($statuses, 0);

        foreach ($totalOrders as $order) {
            $date = $order->created_at->format('j M'); // Format tanggal
            $status = $order->status;
            $total = $order->orderItems->sum('total_amount');

            if (!in_array($date, $categories)) {
                $categories[] = $date;
            }

            foreach ($statuses as $s) {
                $statusData[$s][] = $s === $status ? $total : 0;
                if ($s === $status) {
                    $statusSum[$s] += $total;
                }
            }
        }

        return [
            'chart' => [
                'chart' => ['type' => $request->type ?? 'line'],
                'series' => array_map(function ($status) use ($statusData) {
                    return ['name' => ucfirst($status), 'data' => $statusData[$status]];
                }, $statuses),
                'xaxis' => ['categories' => $categories]
            ],
            'total' => $statusSum,
            'statusColors' => [
                'pending' => 'primary',
                'process' => 'warning',
                'success' => 'success',
                'cancel' => 'danger',
                'done' => 'success'
            ],
            'statusLabels' => [
                'pending' => 'Pending',
                'process' => 'Proses',
                'success' => 'Selesai',
                'cancel' => 'Batal',
                'done' => 'Selesai'
            ]
        ];
    }

    public function reportWeek(Request $request): array
    {
        return $this->generateReport($request, function ($query) {
            $query->whereDate('created_at', '>=', now()->subWeek());
        });
    }

    public function reportMonth(Request $request): array
    {
        return $this->generateReport($request, function ($query) {
            $query->whereDate('created_at', '>=', now()->subMonth());
        });
    }

    public function reportToday(Request $request): array
    {
        return $this->generateReport($request, function ($query) {
            $query->whereBetween('created_at', [now()->startOfDay(), now()->endOfDay()]);
        });
    }
    public function reportSales(Request $request, string $type): array
    {
        switch ($type) {
            case 'today':
                $startDate = now()->startOfDay();
                $endDate = now()->endOfDay();
                break;
            case 'week':
                $startDate = now()->subWeek()->startOfDay();
                $endDate = now()->endOfDay();
                break;
            case 'month':
                $startDate = now()->subMonth()->startOfDay();
                $endDate = now()->endOfDay();
                break;
            default:
                return [];
        }

        $salesData = Order::selectRaw(
            'orders.user_id, COUNT(orders.id) as total_orders, SUM(order_items.price * order_items.quantity) as total_sales'
        )
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->whereBetween('orders.created_at', [$startDate, $endDate])
            ->groupBy('orders.user_id')
            ->with('user:id,name')
            ->get();

        $salesSummary = [];

        foreach ($salesData as $sale) {
            $salesSummary[] = [
                'sales_id' => $sale->user_id,
                'sales_name' => $sale->user->name ?? 'Unknown',
                'total_orders' => $sale->total_orders,
                'total_sales' => $sale->total_sales, 2
            ];
        }

        return [
            'chart' => [
                'chart' => ['type' => $request->type ?? 'line'],
                'series' => [
                    [
                        'name' => 'Total Sales',
                        'data' => array_column($salesSummary, 'total_sales')
                    ]
                ],
                'xaxis' => [
                    'categories' => array_column($salesSummary, 'sales_name')
                ]
            ],
            'sales_summary' => $salesSummary
        ];
    }
}
