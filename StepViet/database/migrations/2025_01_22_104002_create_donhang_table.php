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
            $table->timestamp('NgayDatHang')->useCurrent();
            $table->decimal('TongTien', 10, 2);
            $table->enum('TrangThai', ['Đang xử lý', 'Đã hoàn thành', 'Đã hủy'])->default('Đang xử lý');
            $table->timestamps();
            $table->foreign('MaKH')->references('MaKH')->on('khachhang')->onDelete('cascade');
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
