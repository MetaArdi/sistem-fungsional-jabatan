<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Tambah kolom di tabel pegawai
        Schema::table('pegawai', function (Blueprint $table) {
            $table->string('no_sertifikat', 100)->nullable()->after('nip');
            $table->date('masa_berlaku_sertifikat')->nullable()->after('no_sertifikat');
            $table->string('tahun_predikat_kinerja', 4)->nullable()->after('masa_berlaku_sertifikat');
        });
        
        // Tambah kolom di tabel usulan
        Schema::table('usulan', function (Blueprint $table) {
            $table->string('no_surat_panrb', 100)->nullable()->after('nomor_surat');
        });
    }

    public function down()
    {
        Schema::table('pegawai', function (Blueprint $table) {
            $table->dropColumn(['no_sertifikat', 'masa_berlaku_sertifikat', 'tahun_predikat_kinerja']);
        });
        
        Schema::table('usulan', function (Blueprint $table) {
            $table->dropColumn('no_surat_panrb');
        });
    }
};