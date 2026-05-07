<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            KategoriSeeder::class,  // ✅ Kategori dulu sebelum Product
            ProductSeeder::class,   // ✅ Product butuh kategori_id
            // TransaksiSeeder::class,
        ]);
    }
}