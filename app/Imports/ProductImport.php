<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Product;
use App\Models\Sku;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     * @return void
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            // Skip rows where 'kategori_produk' or 'nama_produk' is missing
            if (empty($row['kategori_produk']) || empty($row['nama_produk'])) {
                continue; // Skip this iteration
            }
            $category = Category::updateOrCreate([
                'name' => $row['kategori_produk']
            ]);

            $product = Product::updateOrCreate([
                'name' => $row['merk'],
                'category_id' => $category->id,
            ], [
                'name' => $row['merk'],
            ]);

            Sku::create([
                'product_id' => $product->id,
                'performance' => $row['kinerja'],
                'name' => $row['nama_produk'],
                'packaging' => $row['kemasan'],
            ]);
        }
    }


    public function headingRow(): int
    {
        return 1;
    }
}
