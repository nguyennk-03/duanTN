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
            $table->foreignId('DanhMuc')->constrained('danhmuc', 'MaLoai')->cascadeOnDelete();
            $table->string('Hinh')->nullable();
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
