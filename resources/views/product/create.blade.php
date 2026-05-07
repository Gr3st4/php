{{-- resources/views/products/create.blade.php --}}
@extends('layout')

@section('title', 'Tambah Produk')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4 class="fw-bold">➕ Tambah Produk</h4>
    <a href="{{ route('product.index') }}" class="btn btn-outline-secondary">← Kembali</a>
</div>

<div class="card border-danger">
    <div class="card-body">
        <form action="{{ route('product.store') }}" method="POST">
            @csrf

            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label">Nama Produk <span class="text-danger">*</span></label>
                    <input type="text" name="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror"
                           value="{{ old('nama_produk') }}" placeholder="Nama produk...">
                    @error('nama_produk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">Merk</label>
                    <input type="text" name="merk" class="form-control"
                           value="{{ old('merk') }}" placeholder="Opsional">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                    <select name="kategori_id" class="form-control">
    <option value="">-- Pilih Kategori --</option>
    @foreach($kategori as $item)
        <option value="{{ $item->id }}">{{ $item->nama }}</option>
    @endforeach
</select>
                    @error('kategori_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Kondisi <span class="text-danger">*</span></label>
                    <select name="kondisi" class="form-select @error('kondisi') is-invalid @enderror">
                        @foreach ($kondisi as $item)
                            <option value="{{ $item }}"
                                {{ old('kondisi') == $item ? 'selected' : '' }}>
                                {{ $item }}
                            </option>
                        @endforeach
                    </select>
                    @error('kondisi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">Harga Beli (Rp) <span class="text-danger">*</span></label>
                    <input type="number" name="harga_beli" class="form-control @error('harga_beli') is-invalid @enderror"
                           value="{{ old('harga_beli') }}" min="1000">
                    @error('harga_beli')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">Harga Jual (Rp) <span class="text-danger">*</span></label>
                    <input type="number" name="harga_jual" class="form-control @error('harga_jual') is-invalid @enderror"
                           value="{{ old('harga_jual') }}" min="1000">
                    @error('harga_jual')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">Stok <span class="text-danger">*</span></label>
                    <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror"
                           value="{{ old('stok', 0) }}" min="0">
                    @error('stok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3"
                              placeholder="Deskripsi produk...">{{ old('deskripsi') }}</textarea>
                </div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-danger">💾 Simpan Produk</button>
                <a href="{{ route('product.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection