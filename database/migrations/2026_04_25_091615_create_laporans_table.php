<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('species');
            $table->date('tanggal_temuan');
            $table->text('deskripsi_temuan');
            $table->string('aktivitas');
            $table->string('alamat_lokasi');
            $table->text('deskripsi_lokasi');
            $table->json('attachments')->nullable(); 
            $table->enum('status', ['Menunggu Verifikasi', 'Terverifikasi', 'Ditolak'])->default('Menunggu Verifikasi');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
