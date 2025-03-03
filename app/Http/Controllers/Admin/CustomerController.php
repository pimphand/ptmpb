<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
        ]));

        return response()->json(['message' => 'Customer created'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
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
            'phone' => 'required|numeric|digits_between:10,13|unique:customers,phone,'.$customer->id,
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
        //
    }

    public function data(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $customers = Customer::when($request->search, function ($query) use ($request) {
            $query->where('name', 'like', "%{$request->search}%")
                ->orWhere('phone', 'like', "%{$request->search}%")
                ->orWhere('store_name', 'like', "%{$request->search}%");
        })
            ->latest()
            ->paginate(10);

        //        dd($customers);
        return CustomerResource::collection($customers);
    }
}
