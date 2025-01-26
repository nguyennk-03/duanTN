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
        Schema::create('donhang', function (Blueprint $table) {
            $table->id('MaDH');
            $table->unsignedBigInteger('MaKH');
            $table->date('NgayDH');
            $table->string('TrangThai');
            $table->string('PhuongThucTT');
            $table->decimal('TongTien', 10, 2);
            $table->unsignedBigInteger('MaGG')->nullable();
            $table->foreign('MaKH')->references('MaKH')->on('khachhang')->onDelete('cascade');
            $table->foreign('MaGG')->references('MaGG')->on('magiamgia')->onDelete('set null');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donhang');
    }
};
