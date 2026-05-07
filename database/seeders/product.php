<?php
namespace Database\Seeders;
use App\Models\Product;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ Ambil kategori dari database, bukan hardcode string
        $tenda   = Kategori::where('kode', 'TND')->first();
        $sleeping= Kategori::where('kode', 'SLB')->first();
        $pakaian = Kategori::where('kode', 'PKN')->first();
        $navigasi= Kategori::where('kode', 'NAV')->first();
        $tas     = Kategori::where('kode', 'TAS')->first();
        $masak   = Kategori::where('kode', 'MSK')->first();

        $products = [
            ['sku'=>'TND-001','nama_produk'=>'Tenda Dome 2P Waterproof', 'kategori_id'=>$tenda->id,   'merk'=>'Consina','harga_beli'=>600000, 'harga_jual'=>850000, 'stok'=>15,'kondisi'=>'Baru'],
            ['sku'=>'TND-002','nama_produk'=>'Tenda Ridge 4P Family',    'kategori_id'=>$tenda->id,   'merk'=>'Rei',    'harga_beli'=>900000, 'harga_jual'=>1450000,'stok'=>5, 'kondisi'=>'Baru'],
            ['sku'=>'SLB-001','nama_produk'=>'Sleeping Bag -5C Mummy',   'kategori_id'=>$sleeping->id,'merk'=>'Eiger',  'harga_beli'=>200000, 'harga_jual'=>320000, 'stok'=>28,'kondisi'=>'Baru'],
            ['sku'=>'SLB-002','nama_produk'=>'Sleeping Bag Envelope 0C', 'kategori_id'=>$sleeping->id,'merk'=>'-',     'harga_beli'=>80000,  'harga_jual'=>180000, 'stok'=>0, 'kondisi'=>'Bekas'],
            ['sku'=>'PKN-001','nama_produk'=>'Jaket Fleece Anti-Angin',  'kategori_id'=>$pakaian->id, 'merk'=>'Consina','harga_beli'=>150000, 'harga_jual'=>275000, 'stok'=>40,'kondisi'=>'Baru'],
            ['sku'=>'NAV-001','nama_produk'=>'Kompas Baseplate Brunton', 'kategori_id'=>$navigasi->id,'merk'=>'Brunton','harga_beli'=>250000, 'harga_jual'=>420000, 'stok'=>12,'kondisi'=>'Baru'],
            ['sku'=>'TAS-001','nama_produk'=>'Carrier 60L Deuter',       'kategori_id'=>$tas->id,     'merk'=>'Deuter', 'harga_beli'=>800000, 'harga_jual'=>1200000,'stok'=>8, 'kondisi'=>'Baru'],
            ['sku'=>'MSK-001','nama_produk'=>'Nesting Cook Set Titanium','kategori_id'=>$masak->id,   'merk'=>'Trangia','harga_beli'=>150000, 'harga_jual'=>285000, 'stok'=>20,'kondisi'=>'Baru'],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate(
                ['sku' => $product['sku']],
                $product
            );
        }
    }
}