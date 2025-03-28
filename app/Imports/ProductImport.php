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
                "name" => $row['kategori_produk'],
            ],
                [
                'name' => $row['kategori_produk'],
            ]);

            $product = Product::updateOrCreate([
                'name' => $row['merk'],
                'category_id' => $category->id,
            ], [
                'name' => $row['merk'],
            ]);

            Sku::updateOrCreate([
                'product_id' => $product->id,
                'name' => $row['nama_produk'],
                'packaging' => $row['kemasan'],
            ], [
                'performance' => $row['kinerja'],
            ]);
        }
    }

    public function headingRow(): int
    {
        return 1;
    }

}
