<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis';

    protected $fillable = [
        'kode_transaksi',
        'user_id',
        'total_harga',
        'status',
        'catatan',
    ];

    const STATUS = ['pending', 'selesai', 'batal'];

    // ✅ Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // ✅ Relasi ke DetailTransaksi
    public function details()
    {
        return $this->hasMany(DetailTransaksi::class, 'transaksi_id');
    }

    // ✅ Relasi ke Product lewat DetailTransaksi
    public function products()
    {
        return $this->hasManyThrough(
            Product::class,
            DetailTransaksi::class,
            'transaksi_id',
            'id',
            'id',
            'product_id'
        );
    }
}