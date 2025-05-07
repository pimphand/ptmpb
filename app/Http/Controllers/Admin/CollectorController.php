<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CollectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.collector.index', [
            'title' => 'Collcetor',

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
        $request->validate([
            'name' => 'required|string',
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone' => 'nullable|numeric|min:10',
            'address' => 'nullable|string',
        ]);

        $user = User::create($request->only('name', 'username', 'email', 'phone', 'address')
            + ['password' => bcrypt($request->password)]);

        if ($request->hasFile('photo')) {
            $user->photo = asset('storage') . "/" . $request->file('photo')->store('photos', 'public');
            $user->save();
        }
        $user->addRole('debt-collector');

        return response()->json(['message' => 'Data berhasil disimpan']);
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

        return view('admin.collector.show', [
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
    public function update(Request $request, User $sale)
    {
        if ($request->omzet) {
            $request->validate([
                'omzet' => ['nullable'],
            ], [
                'omzet.required' => 'Omzet wajib diisi',
                'omzet.numeric' => 'Omzet harus berupa angka',
            ]);

            $sale->target_sales = (int) $request->target_sales;
            $sale->omzet_items = (int) $request->omzet_items;
            $sale->save();

            return response()->json(['message' => 'Data berhasil diubah']);
        }
        if ($request->hasFile('photo')) {
            $sale->photo = asset('storage') . "/" . $request->file('photo')->store('photos', 'public');
            $sale->save();
        }
        $sale->update($request->only('name', 'username', 'email', 'phone', 'address')
            + ['password' => $request->password ? bcrypt($request->password) : $sale->password]);

        return response()->json(['message' => 'Data berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }

    /**
     * Display a listing of the resource.
     */
    public function data(Request $request): AnonymousResourceCollection
    {
        $users = User::when($request->search, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        })->whereDoesntHave('roles', function ($query) {
            $query->where('name', 'developer');
        })
            ->whereHasRole('debt-collector')
            ->withCount('customers', 'orders')
            ->with('roles:id,display_name,name')
            ->paginate(10);

        return UserResource::collection($users);
    }
}
