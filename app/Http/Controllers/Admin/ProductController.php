<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Imports\ProductImport;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Sku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('admin.product', [
            'title' => 'Product',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('admin.product_create', [
            'title' => 'Tambah Produk',
            'categories' => Category::all(),
            'product' => [],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $product = (new Product)->create([
                'name' => $request->name,
                'category_id' => $request->category,
                'file' => $request->has('file') ? $request->file('file')->store('file/products', 'public') : null,
            ]);

            foreach ($request->name_sku as $key => $name_sku) {
                $product->skus()->create([
                    'name' => $name_sku,
                    'description' => $request->description[$key],
                    'packaging' => $request->packaging[$key],
                    'application' => $request->application[$key],
                ]);

                if ($request->hasFile('image.'.$key)) {
                    Image::create([
                        'imaginable_id' => $product->skus->last()->id,
                        'path' => $request->file('image.'.$key)->store('images/products', 'public'),
                        'imaginable_type' => Sku::class,
                    ]);
                }
            }

            return response()->json(['message' => 'Produk berhasil ditambahkan']);
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('admin.product_create', [
            'title' => 'Tambah Produk',
            'categories' => Category::all(),
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        return DB::transaction(function () use ($request, $product) {
            $product->update([
                'name' => $request->name,
                'category_id' => $request->category,
                'file' => $request->has('file') ? $request->file('file')->store('file/products', 'public') : $product->file,
            ]);

            foreach ($request->name_sku as $key => $name_sku) {
                $sku = $product->skus()->updateOrCreate([
                    'id' => isset($request->sku_id[$key]) ? $request->sku_id[$key] : null,
                ], [
                    'name' => $name_sku,
                    'description' => $request->description[$key],
                    'packaging' => $request->packaging[$key],
                    'application' => $request->application[$key],
                ]);

                if ($request->hasFile('image.'.$key)) {
                    Image::updateOrCreate([
                        'imaginable_id' => $sku->id,
                        'imaginable_type' => Sku::class,
                    ], [
                        'path' => $request->file('image.'.$key)->store('images/products', 'public'),
                    ]);
                }
            }

            return response()->json(['message' => 'Produk berhasil diperbarui']);
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): \Illuminate\Http\JsonResponse
    {
        $product->skus()->delete();
        // delete file jika ada
        if ($product->file) {
            Storage::disk('public')->delete($product->file);
        }

        $product->delete();

        return response()->json(['message' => 'Produk berhasil dihapus']);
    }

    /**
     * Get all products
     */
    public function data(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $products = Product::whereLike('name', "%$request->search%")
            ->with('category')
            ->withCount('skus')
            ->paginate(10);

        return ProductResource::collection($products);
    }

    public function skus(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $products = Sku::when($request->search, function ($query) use ($request) {
            $query->where('name', 'like', "%{$request->search}%");
        })
            ->when($request->brand, function ($query) use ($request) {
                $query->whereHas('product', function ($query) use ($request) {
                    $query->where('name', $request->brand);
                });
            })
            ->with(['product.category'])
            ->paginate(10)
            ->appends(request()->query());

        return ProductResource::collection($products);
    }

    /**
     * Upload product
     */
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new ProductImport, request()->file('file'));

        return response()->json(['message' => 'Produk berhasil diupload']);
    }
}
