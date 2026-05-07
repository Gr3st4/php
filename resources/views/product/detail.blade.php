{{-- resources/views/products/show.blade.php --}}
@extends('product.indexs.app')

@section('title', 'Detail Produk')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4 class="fw-bold">🔍 Detail Produk</h4>
    <div class="d-flex gap-2">
        <a href="{{ route('product.edit', $product) }}" class="btn btn-warning">✏️ Edit</a>
        <a href="{{ route('product.index') }}" class="btn btn-outline-secondary">← Kembali</a>
    </div>
</div>

<div class="card border-danger">
    <div class="card-header bg-danger text-white">
        <strong>{{ $product->sku }}</strong> — {{ $product->nama_produk }}
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <p><strong>Kategori</strong><br>
                   {{ $product->kategori->icon }} {{ $product->kategori->nama }}
                </p>
                <p><strong>Merk</strong><br>{{ $product->merk ?? '-' }}</p>
                <p><strong>Kondisi</strong><br>{{ $product->kondisi }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Harga Beli</strong><br>{{ $product->harga_beli_format }}</p>
                <p><strong>Harga Jual</strong><br>{{ $product->harga_jual_format }}</p>
                <p><strong>Stok</strong><br>
                    <span class="badge bg-{{
                        $product->status_stok === 'Habis'  ? 'danger' :
                        ($product->status_stok === 'Rendah' ? 'warning' : 'success')
                    }}">
                        {{ $product->stok }} unit — {{ $product->status_stok }}
                    </span>
                </p>
            </div>
            <div class="col-12">
                <p><strong>Deskripsi</strong><br>
                   {{ $product->deskripsi ?? 'Tidak ada deskripsi.' }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection