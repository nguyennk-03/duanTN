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
        Schema::create('donhangct', function (Blueprint $table) {
            $table->unsignedBigInteger('MaDH');
            $table->unsignedBigInteger('MaSP');
            $table->integer('SoLuong');
            $table->decimal('DonGia', 10, 2);
            $table->foreign('MaDH')->references('MaDH')->on('donhang')->onDelete('cascade');
            $table->foreign('MaSP')->references('MaSP')->on('sanpham')->onDelete('cascade');
            $table->primary(['MaDH', 'MaSP']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donhangct');
    }
};
