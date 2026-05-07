<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'sku',
        'nama_produk',
        'merk',
        'kategori_id',  // ✅ ganti dari 'kategori' string → foreign key
        'harga_beli',
        'harga_jual',
        'stok',
        'kondisi',
        'deskripsi',
    ];

    protected $casts = [
        'harga_beli' => 'integer',
        'harga_jual' => 'integer',
        'stok'       => 'integer',
    ];

    // ✅ Relasi ke Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    // ✅ Relasi ke DetailTransaksi
    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class, 'product_id');
    }

    // ✅ Relasi ke Transaksi lewat DetailTransaksi
    public function transaksis()
    {
        return $this->hasManyThrough(
            Transaksi::class,
            DetailTransaksi::class,
            'product_id',    // FK di detail_transaksis
            'id',            // FK di transaksis
            'id',            // PK di products
            'transaksi_id'   // FK di detail_transaksis
        );
    }

    // ✅ Accessor status stok
    public function getStatusStokAttribute(): string
    {
        if ($this->stok === 0) return 'Habis';
        if ($this->stok <= 5)  return 'Rendah';
        return 'Aman';
    }

    // ✅ Accessor format harga
    public function getHargaJualFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->harga_jual, 0, ',', '.');
    }

    // ✅ Scope pencarian
    public function scopeSearch($query, $keyword)
    {
        return $query->where('nama_produk', 'like', "%$keyword%")
                    ->orWhere('sku', 'like', "%$keyword%");
    }

    // ✅ Scope filter kategori
    public function scopeKategori($query, $kategoriId)
    {
        return $query->where('kategori_id', $kategoriId);
    }
}