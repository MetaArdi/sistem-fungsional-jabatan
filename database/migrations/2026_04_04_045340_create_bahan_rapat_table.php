<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('bahan_rapat')) {
            Schema::create('bahan_rapat', function (Blueprint $table) {
                $table->id();
                $table->foreignId('id_usulan')->constrained('usulan')->onDelete('cascade');
                $table->string('nomor_bahan')->nullable();
                $table->date('tanggal_bahan')->nullable();
                $table->integer('no_urut')->nullable();
                $table->text('kajian_otomatis')->nullable();
                $table->text('tabel_besetting')->nullable();
                $table->enum('status_bahan', ['draft', 'proses', 'menunggu_persetujuan', 'disetujui', 'ditolak'])->default('draft');
                $table->text('alasan_persetujuan')->nullable();
                $table->foreignId('disetujui_oleh')->nullable()->constrained('users')->onDelete('set null');
                $table->timestamp('tanggal_disetujui')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('bahan_rapat');
    }
};