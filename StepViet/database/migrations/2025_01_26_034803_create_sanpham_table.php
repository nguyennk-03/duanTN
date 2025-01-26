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
        Schema::create('sanpham', function (Blueprint $table) {
            $table->id('MaSP');
            $table->string('TenSP', 100);
            $table->text('MoTa')->nullable();
            $table->decimal('GiaBan', 10, 2);
            $table->decimal('GiaGiam', 10, 2)->nullable();
            $table->integer('SoLuong')->default(0);
            $table->unsignedBigInteger('danhmuc');
            $table->unsignedBigInteger('MaTH');
        
            $table->foreign('danhmuc')->references('MaDM')->on('danhmuc')->onDelete('cascade');
            $table->foreign('MaTH')->references('MaTH')->on('thuonghieu')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sanpham');
    }
};
