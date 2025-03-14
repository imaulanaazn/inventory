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
        Schema::create('kebutuhan_barang_jadi', function (Blueprint $table) {
            $table->id();
            $table->string('barang_jadi_id', 36);
            $table->string('bahan_baku_id', 36);
            $table->string('table_source');
            $table->integer('jumlah_kebutuhan');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kebutuhan_barang_jadi');
    }
};
