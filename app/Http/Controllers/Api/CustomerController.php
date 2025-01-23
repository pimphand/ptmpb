<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = Auth::user()->customers()
            ->when($request->search, function ($query, $search) use ($request) {
                return $query->whereAny(["name", "owner_address", "address", "phone"], $search);
            })
            ->where("is_blacklist", $request->is_blacklist ?? false)
            ->orderBy("created_at", "desc")
            ->paginate(10);

        return CustomerResource::collection($customers);
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            "name" => "required",
            "phone" => "required|numeric|digits_between:10,13|unique:customers,phone",
            "address" => "required|",
            "owner_address" => "required",
            "store_name" => "required",
            "store_photo" => "required",
            "owner_photo" => "nullable",
            "identity" => "nullable",
            "npwp" => "nullable",
            "others" => "nullable",
        ]);

        Auth::user()->customers()->create(array_merge($validated->validated(), [
            "store_photo" => $request->file("store_photo")->store("customer/store_photo", "public"), // store file
            "owner_photo" => $request->file("owner_photo")->store("customer/owner_photo", "public"), // store file
        ]));

        return response()->json(["message" => "Customer created"], 201);
    }
}
