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
        Schema::create('data_perawatans', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('pemilik');
            $table->string('teknisi');
            $table->integer('mesin_id');
            $table->date('tanggal_perawatan');
            $table->string('aktivitas');
            $table->string('catatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_perawatans');
    }
};
