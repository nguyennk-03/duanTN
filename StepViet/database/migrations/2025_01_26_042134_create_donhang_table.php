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
            $table->id('id');
            $table->foreignId('khachhang_id')->constrained('khachhang')->onDelete('cascade');
            $table->date('ngaydh');
            $table->string('trangthai');
            $table->string('phuongthuctt');
            $table->decimal('tongtien', 10, 2);
            $table->foreignId('magiamgia_id')->nullable()->constrained('magiamgia')->onDelete('set null');
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
