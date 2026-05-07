@extends('layout')

@section('content')
<div class="container">
    <h2>Detail Produk</h2>
    <hr>
    <ul>
        <li><strong>Nama Produk:</strong> {{ $product->nama_produk }}</li>
        <li><strong>SKU:</strong> {{ $product->sku }}</li>
        <li><strong>Harga Jual:</strong> Rp{{ number_format($product->harga_jual) }}</li>
        <li><strong>Stok:</strong> {{ $product->stok }}</li>
    </ul>
    <a href="{{ route('product.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
</div>
@endsection