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
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description.*' => 'required|string',
            'packaging.*' => 'required|string',
            'application.*' => 'required|string',
        ];
    }
}
