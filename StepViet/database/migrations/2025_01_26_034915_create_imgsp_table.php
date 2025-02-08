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
        Schema::create('imgsp', function (Blueprint $table) {
            $table->id('MaHinh');
            $table->unsignedBigInteger('MaSP');
            $table->string('DuongDan', 255);
            $table->foreign('MaSP')->references('MaSP')->on('sanpham')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imgsp');
    }
};
