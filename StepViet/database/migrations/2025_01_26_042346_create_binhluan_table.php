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
        Schema::create('binhluan', function (Blueprint $table) {
            $table->unsignedBigInteger('MaKH');
            $table->unsignedBigInteger('MaSP');
            $table->text('NoiDung');
            $table->date('NgayBL');
            $table->foreign('MaKH')->references('MaKH')->on('khachhang')->onDelete('cascade');
            $table->foreign('MaSP')->references('MaSP')->on('sanpham')->onDelete('cascade');
            $table->primary(['MaKH', 'MaSP']);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('binhluan');
    }
};
