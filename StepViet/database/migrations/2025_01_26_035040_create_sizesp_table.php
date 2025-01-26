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
        Schema::create('kichco_sanpham', function (Blueprint $table) {
            $table->id('MaSize');
            $table->unsignedBigInteger('MaSP');
            $table->string('Size', 10);
            $table->integer('SoLuong')->default(0);
            $table->foreign('MaSP')->references('MaSP')->on('sanpham')->onDelete('cascade');   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sizesp');
    }
};
