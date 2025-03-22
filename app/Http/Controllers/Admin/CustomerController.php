<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Factory|Application
    {
        return view('admin.customer', [
            'title' => 'Customer',
            'sales' => User::whereHasRole('sales')->get(),
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
    public function store(Request $request): JsonResponse
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|numeric|digits_between:10,13|unique:customers,phone',
            'address' => 'required|',
            'store_name' => 'required',
            'store_photo' => 'required',
            'owner_photo' => 'nullable',
            'identity' => 'nullable',
            'npwp' => 'nullable',
            'others' => 'nullable',
            'user_id' => 'required|exists:users,id',

        ]);

        Customer::create(array_merge($validated->validated(), [
            'store_photo' => $request->file('store_photo')->store('customer/store_photo', 'public'),
            'owner_photo' => $request->file('owner_photo')->store('customer/owner_photo', 'public'),
            'user_id' => $request->user_id,
            'is_blacklist' => $request->is_blacklist,
            'city' => $request->city,
            'state' => $request->state,
        ]));

        return response()->json(['message' => 'Customer created'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        $remaining = DB::table('payments as p1')
            ->selectRaw('SUM(p1.remaining) as total_remaining')
            ->whereRaw('p1.created_at = (
        SELECT MAX(p2.created_at)
        FROM payments p2
        WHERE p2.order_id = p1.order_id
    )')
            ->whereIn('p1.order_id', Order::where('customer_id', $customer->id)->whereIn('status', ['success', 'done'])->pluck('id'))
            ->value('total_remaining');

        $order = Order::where('customer_id', $customer->id)
            ->whereIn('orders.status', ['success', 'done'])
            ->whereBetween('orders.created_at', [now()->startOfYear(), now()->endOfYear()])
            ->leftJoin('order_items', 'orders.id', '=', 'order_items.order_id')
            ->selectRaw('orders.status, COALESCE(SUM(order_items.quantity * order_items.price), 0) as total_pembelian')
            ->selectRaw('orders.status,COALESCE(SUM(order_items.returns * order_items.price), 0) as total_retur')
            ->selectRaw('orders.status,COALESCE(SUM(order_items.returns), 0) as total_produk_retur')
            ->selectRaw('orders.status,COALESCE(SUM(order_items.quantity), 0) as total_produk')
            ->selectRaw('orders.status,COALESCE(SUM(orders.discount), 0) as total_discount')
            ->groupBy('orders.status')
            ->first();

        if ($remaining) {
            $order->total_remaining_payment = $remaining;
        }
        return view('admin.customer_detail', compact('customer', 'order',));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|numeric|digits_between:10,13|unique:customers,phone,' . $customer->id,
            'address' => 'required|',
            'owner_photo' => 'nullable',
            'identity' => 'nullable',
            'npwp' => 'nullable',
            'others' => 'nullable',
            'user_id' => 'required|exists:users,id',
        ]);

        $customer->update(array_merge($validated->validated(), [
            'store_photo' => $request->file('store_photo') ? $request->file('store_photo')->store('customer/store_photo', 'public') : $customer->store_photo,
            'owner_photo' => $request->file('owner_photo') ? $request->file('owner_photo')->store('customer/owner_photo', 'public') : $customer->owner_photo,
            'user_id' => $request->user_id,
            'is_blacklist' => $request->is_blacklist == 1 ? true : false,
            'city' => $request->city,
            'state' => $request->state,
        ]));

        return [
            'message' => 'Data berhasil disimpan',
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response()->json(['message' => 'Customer deleted']);
    }

    public function data(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $customers = Customer::when($request->search, function ($query) use ($request) {
            $query->where('name', 'like', "%{$request->search}%")
                ->orWhere('phone', 'like', "%{$request->search}%")
                ->orWhere('state', 'like', "%{$request->search}%")
                ->orWhere('city', 'like', "%{$request->search}%")
                ->orWhere('address', 'like', "%{$request->search}%")
                ->orWhere('store_name', 'like', "%{$request->search}%");
        })
            ->when($request->sales,function ($query) use ($request){
                $query->where('user_id', $request->sales);
            })
            ->with('sales:id,name')
            ->leftJoin(DB::raw('(
        SELECT id, customer_id
        FROM orders
        WHERE status != "cancel"
    ) valid_orders'), 'customers.id', '=', 'valid_orders.customer_id')
            ->leftJoin(DB::raw('(
        SELECT p1.order_id, p1.amount, p1.remaining
        FROM payments p1
        JOIN (
            SELECT order_id, MAX(date) as latest_date
            FROM payments
            GROUP BY order_id
        ) p2 ON p1.order_id = p2.order_id AND p1.date = p2.latest_date
    ) latest_payments'), 'valid_orders.id', '=', 'latest_payments.order_id')
            ->leftJoin(DB::raw('(
        SELECT order_id, SUM(quantity * price) as total_value
        FROM order_items
        WHERE order_id IN (SELECT id FROM orders WHERE status != "cancel")
        GROUP BY order_id
    ) order_values'), 'valid_orders.id', '=', 'order_values.order_id')
            ->leftJoin(DB::raw('(
        SELECT customer_id, SUM(discount) as total_discount
        FROM orders
        WHERE status != "cancel" AND status = "success"
        GROUP BY customer_id
    ) order_discounts'), 'customers.id', '=', 'order_discounts.customer_id')
            ->select(
                'customers.id',
                'customers.user_id',
                'customers.name',
                'customers.phone',
                'customers.store_name',
                'customers.city',
                'customers.state',
                'customers.address',
                'customers.is_blacklist',
                'customers.created_at',
                'customers.updated_at',
                'customers.deleted_at',
                DB::raw('IFNULL(SUM(order_values.total_value), 0) as total_order_value'),
                DB::raw('IFNULL(MAX(latest_payments.remaining), 0) as total_remaining'),
                DB::raw('IFNULL(MAX(order_discounts.total_discount), 0) as total_discount')
            )
            ->groupBy(
                'customers.id',
                'customers.user_id',
                'customers.name',
                'customers.phone',
                'customers.city',
                'customers.state',
                'customers.address',
                'customers.store_name',
                'customers.is_blacklist',
                'customers.created_at',
                'customers.updated_at',
                'customers.deleted_at'
            )
            ->paginate(10)
            ->appends($request->query());

        return CustomerResource::collection($customers);
    }
}
