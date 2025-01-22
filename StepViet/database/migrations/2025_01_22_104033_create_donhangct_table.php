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
            $table->foreignId('MaDH')->constrained('donhang', 'MaDH');
            $table->foreignId('MaSP')->constrained('sanpham', 'MaSP');
            $table->integer('SoLuong');
            $table->decimal('DonGia', 10, 2);
            $table->primary(['MaDH', 'MaSP']);
            $table->timestamps();
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
