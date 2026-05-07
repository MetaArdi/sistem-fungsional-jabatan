<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->string('nip', 18)->primary();
            $table->string('nama_lengkap', 255);
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('agama', 20);
            $table->string('status_perkawinan', 20);
            $table->text('alamat');
            $table->string('no_hp', 20);
            $table->string('email', 100);
            $table->string('id_opd', 20);
            $table->string('pangkat', 100);
            $table->string('golongan', 10);
            $table->date('tmt_pangkat');
            $table->string('jabatan_saat_ini', 255);
            $table->string('unit_kerja', 255);
            $table->decimal('angka_kredit', 10, 3);
            $table->integer('usia_tahun');
            $table->integer('usia_bulan');
            $table->string('pendidikan_terakhir', 50);
            $table->string('jurusan', 255);
            $table->year('tahun_lulus');
            $table->timestamps();

            $table->foreign('id_opd')->references('id_opd')->on('opd')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pegawai');
    }
};