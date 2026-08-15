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
        Schema::create('plants', function (Blueprint $table) {
            $table->id();
            $table->string('kode_tumbuhan')->unique(); 
            $table->string('nama_tumbuhan');           
            $table->string('nama_latin');              
            $table->string('famili')->nullable();      
            $table->text('deskripsi'); 
            $table->string('gambar')->nullable();       
            $table->string('qr_code_path')->nullable(); // Tempat menyimpan file QR Code
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plants');
    }
};