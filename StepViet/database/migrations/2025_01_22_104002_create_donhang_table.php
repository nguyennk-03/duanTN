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
            $table->foreignId('MaKH')->constrained('khachhang', 'MaKH');
            $table->dateTime('NgayDH');
            $table->string('TrangThai')->nullable();
            $table->string('PhuongThucTT')->nullable();
            $table->decimal('TongTien', 15, 2);
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
