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
        Schema::create('log_integrasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usulan')->nullable();
            $table->unsignedBigInteger('id_sk')->nullable();
            $table->string('aksi');
            $table->string('status');
            $table->text('response')->nullable();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->timestamps();
            
            // Opsional: tambahkan foreign key constraints jika relasi ada.
            // $table->foreign('id_usulan')->references('id')->on('usulan')->onDelete('cascade');
            // $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_integrasi');
    }
};
