<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // ✅ Izinkan semua user, sesuaikan jika pakai auth
    }

    public function rules()
{
    $product = $this->route('product');
$productId = $product ? $product->id : null;
    return [
        'nama_produk' => 'required|string|max:100',
        'kategori_id' => 'required', // Pastikan ini bukan array
        'kondisi'     => 'required', 
        'harga_beli'  => 'required|numeric',
        'harga_jual'  => 'required|numeric',
        'stok'        => 'required|numeric',
    ];
}

    public function messages(): array
    {
        return [
            'nama_produk.required' => 'Nama produk wajib diisi.',
            'nama_produk.max'      => 'Nama produk maksimal 100 karakter.',
            'kategori.required'    => 'Kategori wajib dipilih.',
            'kategori.in'          => 'Kategori tidak valid.',
            'harga_beli.required'  => 'Harga beli wajib diisi.',
            'harga_beli.min'       => 'Harga beli minimal Rp 1.000.',
            'harga_jual.required'  => 'Harga jual wajib diisi.',
            'harga_jual.gte'       => 'Harga jual tidak boleh lebih kecil dari harga beli.',
            'stok.required'        => 'Stok wajib diisi.',
            'stok.min'             => 'Stok tidak boleh minus.',
            'kondisi.required'     => 'Kondisi wajib dipilih.',
            'kondisi.in'           => 'Kondisi hanya boleh Baru atau Bekas.',
        ];
    }
}