// database/migrations/xxxx_create_products_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku', 20)->unique();
            $table->string('nama_produk', 100);
            $table->string('merk', 50)->nullable();

            // ✅ Ganti enum kategori → foreign key ke tabel kategori
            $table->foreignId('kategori_id')
                  ->constrained('kategori')
                  ->onDelete('restrict'); // ← tidak bisa hapus kategori jika masih ada produk

            $table->decimal('harga_beli', 12, 0);
            $table->decimal('harga_jual', 12, 0);
            $table->integer('stok')->default(0);
            $table->enum('kondisi', ['Baru', 'Bekas'])->default('Baru');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};