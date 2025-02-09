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
            $table->id();
            $table->string('tensp');
            $table->text('mota')->nullable();
            $table->decimal('giaban', 10, 2);
            $table->decimal('giagiam', 10, 2)->nullable();
            $table->integer('soluong');
            $table->unsignedBigInteger('danhmuc_id');
            $table->unsignedBigInteger('thuonghieu_id');
            $table->string('sizesp')->nullable();
            $table->string('img')->nullable();
            $table->timestamps();
        
            $table->foreign('danhmuc_id')->references('id')->on('danhmuc')->onDelete('cascade');
            $table->foreign('thuonghieu_id')->references('id')->on('thuonghieu')->onDelete('cascade');
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
