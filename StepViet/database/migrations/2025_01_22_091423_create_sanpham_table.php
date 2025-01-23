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
            $table->string('TenSP');
            $table->text('MoTa')->nullable();
            $table->decimal('GiaBan', 10, 2);
            $table->unsignedBigInteger('DanhMuc');
            $table->unsignedBigInteger('MaTH');
            $table->integer('SoLuong')->unsigned()->default(0);
            $table->string('HinhAnh')->nullable(); 
            $table->timestamps();
            $table->foreign('DanhMuc')->references('MaDM')->on('danhmuc')->onDelete('cascade');
            $table->foreign('MaTH')->references('MaTH')->on('thuonghieu')->onDelete('cascade');
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
