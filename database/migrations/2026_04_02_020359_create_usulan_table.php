<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Cek apakah tabel usulan sudah ada
        if (!Schema::hasTable('usulan')) {
            Schema::create('usulan', function (Blueprint $table) {
                $table->id();
                $table->string('nip', 18);
                $table->string('id_opd_pengusul', 20);
                $table->unsignedBigInteger('id_user_pengusul');
                $table->enum('jenis_usulan', ['kenaikan', 'perpindahan', 'pemberhentian']);
                
                $table->string('jabatan_lama', 255);
                $table->string('golongan_lama', 10);
                $table->string('unit_kerja_lama', 255);
                
                $table->string('jabatan_baru', 255)->nullable();
                $table->string('golongan_baru', 10)->nullable();
                $table->string('unit_kerja_tujuan', 255)->nullable();
                $table->decimal('angka_kredit_usulan', 10, 3)->nullable();
                
                $table->text('alasan_perpindahan')->nullable();
                
                $table->string('alasan_pemberhentian', 100)->nullable();
                $table->date('tanggal_efektif')->nullable();
                
                $table->string('nomor_surat', 100);
                $table->string('jenis_surat', 255);
                $table->integer('jumlah_bandel');
                $table->text('keterangan_surat');
                $table->string('file_surat_pengantar', 255);
                
                $table->enum('status', [
                    'menunggu_verifikasi',
                    'sedang_diverifikasi',
                    'ditolak_verifikator',
                    'menunggu_persetujuan',
                    'ditolak_administrasi',
                    'sk_diterbitkan',
                    'selesai'
                ])->default('menunggu_verifikasi');
                $table->text('alasan_penolakan')->nullable();
                
                $table->timestamps();
                
                $table->foreign('nip')->references('nip')->on('pegawai')->onDelete('cascade');
                $table->foreign('id_opd_pengusul')->references('id_opd')->on('opd')->onDelete('cascade');
                $table->foreign('id_user_pengusul')->references('id')->on('users')->onDelete('cascade');
            });
        }
        
        // Cek apakah tabel usulan_berkas sudah ada
        if (!Schema::hasTable('usulan_berkas')) {
            Schema::create('usulan_berkas', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('id_usulan');
                $table->string('jenis_berkas', 50);
                $table->string('nama_file', 255);
                $table->string('path_file', 255);
                $table->timestamps();
                
                $table->foreign('id_usulan')->references('id')->on('usulan')->onDelete('cascade');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('usulan_berkas');
        Schema::dropIfExists('usulan');
    }
};