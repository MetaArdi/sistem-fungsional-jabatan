<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pegawai', function (Blueprint $table) {
            $table->enum('status_aktif', ['aktif', 'nonaktif'])->default('aktif')->after('tahun_lulus');
        });
    }

    public function down()
    {
        Schema::table('pegawai', function (Blueprint $table) {
            $table->dropColumn('status_aktif');
        });
    }
};
