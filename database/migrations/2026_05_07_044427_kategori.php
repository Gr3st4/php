// database/migrations/xxxx_create_kategori_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategori', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50)->unique();   // Tenda, Sleeping, dll
            $table->string('kode', 5)->unique();    // TND, SLB, dll
            $table->string('icon', 10)->nullable(); // ⛺ 🛌 dll
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori');
    }
};