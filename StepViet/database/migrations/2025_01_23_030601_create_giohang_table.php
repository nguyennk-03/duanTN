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
        Schema::create('giohang', function (Blueprint $table) {
            $table->id('MaGH'); 
            $table->unsignedBigInteger('MaKH'); 
            $table->unsignedBigInteger('MaSP'); 
            $table->integer('SoLuong')->default(1);
            $table->string('KichCo', 10)->nullable();
            $table->string('MauSac', 50)->nullable(); 
            $table->timestamp('NgayThem')->useCurrent(); 
            $table->timestamps();

            $table->foreign('MaKH')->references('MaKH')->on('khachhang')->onDelete('cascade');
            $table->foreign('MaSP')->references('MaSP')->on('sanpham')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('giohang');
    }
};
