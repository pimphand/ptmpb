<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'name_sku.*' => 'required|string|max:255',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'description.*' => 'required|string',
            'packaging.*' => 'required|string',
            'application.*' => 'required|string',
        ];
    }
    /*
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Produk harus memiliki nama.',
            'name.string' => 'Nama produk harus berupa teks.',
            'name.max' => 'Nama produk tidak boleh lebih dari :max karakter.',
            'category.required' => 'Produk harus memiliki kategori.',
            'category.exists' => 'Kategori produk tidak valid.',
            'name_sku.*.required' => 'SKU harus memiliki nama.',
            'name_sku.*.string' => 'Nama SKU harus berupa teks.',
            'name_sku.*.max' => 'Nama SKU tidak boleh lebih dari :max karakter.',
            'image.*.required' => 'SKU harus memiliki gambar.',
            'image.*.image' => 'Gambar harus berupa file gambar.',
            'image.*.mimes' => 'Gambar harus berupa file gambar dengan format jpeg, png, jpg, gif, svg, atau webp.',
            'image.*.max' => 'Gambar tidak boleh lebih dari :max kilobytes.',
            'description.*.required' => 'SKU harus memiliki deskripsi.',
            'description.*.string' => 'Deskripsi harus berupa teks.',
            'packaging.*.required' => 'SKU harus memiliki kemasan.',
            'packaging.*.string' => 'Kemasan harus berupa teks.',
            'application.*.required' => 'SKU harus memiliki aplikasi.',
            'application.*.string' => 'Aplikasi harus berupa teks.',
        ];
    }
}
