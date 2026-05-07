<?php
namespace Database\Seeders;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Kategori::LIST as $item) {
            Kategori::firstOrCreate(
                ['kode' => $item['kode']],
                $item
            );
        }
    }
}