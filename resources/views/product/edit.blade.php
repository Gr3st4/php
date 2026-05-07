{{-- resources/views/products/edit.blade.php --}}
@extends('layout')

@section('title', 'Edit Produk')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4 class="fw-bold">✏️ Edit Produk</h4>
    <a href="{{ route('product.index') }}" class="btn btn-outline-secondary">← Kembali</a>
</div>

<div class="card border-warning">
    <div class="card-body">
        <form action="{{ route('product.update', $product) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label">Nama Produk *</label>
                    <input type="text" name="nama_produk"
                           class="form-control @error('nama_produk') is-invalid @enderror"
                           value="{{ old('nama_produk', $product->nama_produk) }}">
                    @error('nama_produk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">Merk</label>
                    <input type="text" name="nama_produk" class="form-control"
                           value="{{ old('merk', $product->merk) }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Kategori *</label>
                    <select name="kategori_id"
                            class="form-select @error('kategori_id') is-invalid @enderror">
                        @foreach ($kategori as $kat)
                            <option value="{{ $kat->id }}"
                                {{ $product->kategori_id == $kat->id ? 'selected' : '' }}>
                                {{ $kat->icon }} {{ $kat->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Kondisi *</label>
                    <select name="kondisi" class="form-select">
                        @foreach ($kondisi as $item)
                            <option value="{{ $item }}"
                                {{ old('kondisi', $product->kondisi) == $item ? 'selected' : '' }}>
                                {{ $item }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Harga Beli *</label>
                    <input type="number" name="harga_beli"
                           class="form-control @error('harga_beli') is-invalid @enderror"
                           value="{{ old('harga_beli', $product->harga_beli) }}" min="1000">
                    @error('harga_beli')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">Harga Jual *</label>
                    <input type="number" name="harga_jual"
                           class="form-control @error('harga_jual') is-invalid @enderror"
                           value="{{ old('harga_jual', $product->harga_jual) }}" min="1000">
                    @error('harga_jual')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">Stok *</label>
                    <input type="number" name="stok"
                           class="form-control @error('stok') is-invalid @enderror"
                           value="{{ old('stok', $product->stok) }}" min="0">
                    @error('stok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3">
                        {{ old('deskripsi', $product->deskripsi) }}
                    </textarea>
                </div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-warning">💾 Update Produk</button>
                <a href="{{ route('product.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection