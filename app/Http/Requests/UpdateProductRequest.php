<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|', 
            'purchase_price' => 'required|numeric|min:0', 
            'sale_price' => 'nullable|numeric|min:0', 
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id', 
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

     /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama produk harus diisi.',
            'purchase_price.required' => 'Harga beli harus diisi.',
            'purchase_price.numeric' => 'Harga beli harus berupa angka.',
            'purchase_price.min' => 'Harga beli tidak boleh kurang dari 0.',
            'sale_price.numeric' => 'Harga jual harus berupa angka.',
            'sale_price.min' => 'Harga jual tidak boleh kurang dari 0.',
            'stock.required' => 'Stok barang harus diisi.',
            'stock.integer' => 'Stok barang harus berupa bilangan bulat.',
            'stock.min' => 'Stok barang tidak boleh kurang dari 0.',
            'category_id.required' => 'Kategori produk harus diisi',
            'image.max' => 'Ukuran gambar maksimal 100KB.',
            'image.mimes' => 'Gambar harus berupa file dengan format: png atau jpg.',
        ];
    }
}
