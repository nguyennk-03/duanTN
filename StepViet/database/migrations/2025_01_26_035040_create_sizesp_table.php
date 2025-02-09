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
        Schema::create('sizesp', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('sanpham_id')->constrained('sanpham')->onDelete('cascade');
            $table->string('size', 10);
            $table->integer('soluong')->default(0);
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
