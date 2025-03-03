<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.sales.index', [
            'title' => 'Sales',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $sale)
    {
        $order = Order::where('user_id', $sale->id)
            ->whereIn('orders.status', ['success', 'done']) // Menyebutkan tabel dengan eksplisit
            ->whereBetween('orders.created_at', [now()->startOfYear(), now()->endOfYear()])
            ->leftJoin('order_items', 'orders.id', '=', 'order_items.order_id')
            ->selectRaw('orders.status, COALESCE(SUM(order_items.quantity * order_items.price), 0) as total')
            ->groupBy('orders.status')
            ->first();

        $status = Order::where('user_id', $sale->id)
            ->whereBetween('orders.created_at', [now()->startOfYear(), now()->endOfYear()])
            ->selectRaw('orders.status, COUNT(orders.id) as total') // Perbaikan selectRaw()
            ->groupBy('orders.status')
            ->get();

        return view('admin.sales.show', [
            'title' => 'User Detail',
            'user' => $sale->load(['roles:id,display_name,name', 'customers', 'orders']),
            'order' => $order,
            'status' => $status,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function data(Request $request): AnonymousResourceCollection
    {
        $users = User::when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('email', 'like', '%'.$request->search.'%');
            })
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'developer');
            })
            ->whereHasRole('sales')
            ->withCount('customers', 'orders')
            ->with('roles:id,display_name,name')
            ->paginate(10);

        return UserResource::collection($users);
    }
}
