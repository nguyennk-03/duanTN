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
        Schema::create('nguoidung', function (Blueprint $table) {
            $table->id('MaND');
            $table->string('TenND');
            $table->string('Email')->unique();
            $table->string('MatKhau');
            $table->string('SDT')->nullable();
            $table->text('DiaChi')->nullable();
            $table->unsignedBigInteger('MaRole')->nullable();
            $table->foreign('MaRole')->references('MaRole')->on('role')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nguoidung');
    }
};
