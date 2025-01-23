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
        Schema::create('thanhtoan', function (Blueprint $table) {
            $table->id('MaTT');
            $table->unsignedBigInteger('MaDH');
            $table->decimal('TongTien', 10, 2);
            $table->enum('PhuongThucThanToan', ['Thẻ tín dụng', 'paypal', 'Chuyển khoản ngân hàng']);
            $table->enum('TrangThai', ['Đang Xử Lý', 'Hoàn Thành', 'Thất Bại']);
            $table->timestamps();

            
            $table->foreign('MaDH')->references('MaDH')->on('donhang')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thanhtoan');
    }
};
