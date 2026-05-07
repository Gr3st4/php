<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';

    protected $fillable = [
        'nama',
        'kode',
        'icon',
        'deskripsi',
    ];

    // ✅ Konstanta dipindah ke sini dari Product
    const LIST = [
        ['nama' => 'Tenda',   'kode' => 'TND', 'icon' => '⛺'],
        ['nama' => 'Sleeping','kode' => 'SLB', 'icon' => '🛌'],
        ['nama' => 'Pakaian', 'kode' => 'PKN', 'icon' => '🧥'],
        ['nama' => 'Navigasi','kode' => 'NAV', 'icon' => '🧭'],
        ['nama' => 'Tas',     'kode' => 'TAS', 'icon' => '🎒'],
        ['nama' => 'Masak',   'kode' => 'MSK', 'icon' => '🍳'],
    ];

    const KONDISI = ['Baru', 'Bekas'];

    // ✅ Relasi — satu kategori punya banyak produk
    public function products()
    {
        return $this->hasMany(Product::class, 'kategori_id');
    }

    // ✅ Accessor — tampilkan icon + nama sekaligus
    public function getNamaLengkapAttribute(): string
    {
        return $this->icon . ' ' . $this->nama;
    }

    // ✅ Hitung total produk dalam kategori ini
    public function getTotalProdukAttribute(): int
    {
        return $this->products()->count();
    }
}