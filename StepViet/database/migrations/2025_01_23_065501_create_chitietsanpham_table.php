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
        Schema::create('chitietsanpham', function (Blueprint $table) {
            $table->id('MaCTSP'); 
            $table->unsignedBigInteger('MaSP'); 
            $table->unsignedBigInteger('MaKT'); 
            $table->unsignedBigInteger('MaMau');
            $table->integer('SoLuongTon')->default(0); 
            $table->timestamps();

            $table->foreign('MaSP')->references('MaSP')->on('sanpham')->onDelete('cascade');
            $table->foreign('MaKT')->references('MaKT')->on('kichthuocsp')->onDelete('cascade');
            $table->foreign('MaMau')->references('MaMau')->on('mausacsp')->onDelete('cascade');

            $table->unique(['MaSP', 'MaKT', 'MaMau']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chitietsanpham');
    }
};
