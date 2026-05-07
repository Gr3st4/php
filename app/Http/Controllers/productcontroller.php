<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\Kategori;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

class productcontroller extends Controller
{
public function index(Request $request) 
{
    // Menggunakan paginate agar variabel $products memiliki data untuk ditampilkan
    $products = Product::query()
        ->when($request->search, function ($query) use ($request) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        })
        ->paginate(10);

    $kategori = Kategori::all();

    // Pastikan namanya 'products' (jamak)
    return view('product.index', compact('products', 'kategori')); 
}

    public function create()
    {
        // ✅ Ambil dari model Kategori, bukan konstanta di Product
        $kategori = Kategori::all();
        $kondisi   = Kategori::KONDISI;

        $kategori = kategori::all();

        return view('product.create', compact('kategori', 'kondisi'));
    }

    public function show($id)
{
    // Mengambil data produk berdasarkan ID
    $product = Product::findOrFail($id);
    
    // Mengarahkan ke file view detail (pastikan file ini sudah kamu buat)
    return view('product.show', compact('product'));
}

    public function store(ProductRequest $request)
    {
        $data        = $request->validated();
        $kategori    = Kategori::findOrFail($request->kategori_id);
        $data['sku'] = $this->generateSku($kategori->kode);
        $data['user_id'] = 10;

        Product::create($data);

        return redirect()->route('product.index')
                         ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kategori = Kategori::all();
        $product   = product::findOrFail($id);
        $kondisi = ['Baru', 'Bekas'];

        return view('product.edit', compact('product', 'kategori', 'kondisi'));
    }

   public function update(Request $request, $id)
{
    // 1. Cari data produk berdasarkan ID
    $product = Product::findOrFail($id);

    // 2. Tampung hasil validasi ke dalam variabel $validatedData
    $validatedData = $request->validate([
        'nama_produk' => 'required',
        'kategori_id' => 'required',
        'harga_jual'  => 'required|numeric',
        'harga_beli'  => 'required|numeric',
        'stok'        => 'required|numeric',
        'kondisi'     => 'required',
        'deskripsi'   => 'nullable', 
    ]);

    // 3. Update produk menggunakan variabel yang sudah menampung data tadi
    $product->update($validatedData);

    // 4. Redirect kembali ke halaman index
    return redirect()->route('product.index')
        ->with('success', 'Produk berhasil diperbarui!');
}

    public function destroy($id)
    {
        $product = product::findOrFail($id);
        $product->delete();

        return redirect()->route('product.index')
                         ->with('success', 'Produk berhasil dihapus!');
    }

    private function generateSku(string $kode): string
    {
        do {
            $last   = Product::where('sku', 'like', $kode . '-%')
                             ->orderByDesc('id')->value('sku');
            $number = $last ? (int) substr($last, -3) + 1 : 1;
            $sku    = $kode . '-' . str_pad($number, 3, '0', STR_PAD_LEFT);
        } while (Product::where('sku', $sku)->exists());

        return $sku;
    }
}