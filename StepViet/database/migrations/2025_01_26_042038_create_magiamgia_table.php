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
        Schema::create('magiamgia', function (Blueprint $table) {
            $table->id('MaGG');
            $table->string('TenGG');
            $table->decimal('GiaTri', 10, 2);
            $table->date('NgayBatDau');
            $table->date('NgayKetThuc');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('magiamgia');
    }
};
