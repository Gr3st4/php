{{-- resources/views/products/index.blade.php --}}
@extends('layout')

@section('title', 'Daftar Produk')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold">📦 Daftar Produk</h4>
    <a href="{{ route('product.create') }}" class="btn btn-danger">+ Tambah Produk</a>
</div>

{{-- Filter --}}
<form method="GET" action="{{ route('product.index') }}" class="row g-2 mb-3">
    <div class="col-md-5">
        <input type="text" name="search" class="form-control"
               placeholder="Cari nama / SKU..." value="{{ request('search') }}">
    </div>
    <div class="col-md-4">
        <select name="kategori_id" class="form-select">
            <option value="">Semua Kategori</option>
            @foreach ($kategori as $kat)
                <option value="{{ $kat->id }}"
                    {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>
                    {{ $kat->icon }} {{ $kat->nama }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <button type="submit" class="btn btn-outline-danger w-100">Cari</button>
    </div>
</form>

{{-- Tabel --}}
<div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-danger">
            <tr>
                <th>#</th>
                <th>SKU</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga Jual</th>
                <th>Stok</th>
                <th>Kondisi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $i => $product)
            <tr>
                <td>{{ $products->firstItem() + $i }}</td>
                <td><code>{{ $product->sku }}</code></td>
                <td>{{ $product->nama_produk }}</td>
                <td>
                    {{ $product->kategori->icon }}
                    {{ $product->kategori->nama }}
                </td>
                <td>{{ $product->harga_jual_format }}</td>
                <td>
                    <span class="badge bg-{{
                        $product->status_stok === 'Habis'  ? 'danger' :
                        ($product->status_stok === 'Rendah' ? 'warning' : 'success')
                    }}">
                        {{ $product->stok }} ({{ $product->status_stok }})
                    </span>
                </td>
                <td>{{ $product->kondisi }}</td>
                <td>
                    <a href="{{ route('product.show', $product->id) }}"
                       class="btn btn-sm btn-info">Detail</a>
                    <a href="{{ route('product.edit', $product) }}"
                       class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('product.destroy', $product) }}"
                          method="POST" class="d-inline"
                          onsubmit="return confirm('Yakin hapus produk ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center text-muted">
                    Tidak ada produk ditemukan.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Pagination --}}
{{ $products->links() }}
@endsection