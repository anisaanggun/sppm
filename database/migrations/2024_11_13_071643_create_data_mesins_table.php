<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_mesins', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('nama_mesin');
            $table->integer('brand_id');
            $table->string('model');
            $table->integer('pemilik_id');
            $table->string('deskripsi')->nullable(); // Menambahkan deskripsi
            $table->string('image')->nullable(); // Menambahkan kolom untuk menyimpan nama file gambar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_mesins');
    }
};
