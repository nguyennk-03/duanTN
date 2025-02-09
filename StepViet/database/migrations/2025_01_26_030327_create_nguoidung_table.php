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
            $table->id('id');
            $table->string('tennd');
            $table->string('email')->unique();
            $table->string('matkhau');
            $table->string('sdt')->nullable();
            $table->text('diachi')->nullable();
            $table->foreignId('role_id')->nullable()->constrained('role')->onDelete('set null');
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
