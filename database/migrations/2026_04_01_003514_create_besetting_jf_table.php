<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('besetting_jf', function (Blueprint $table) {
            $table->id();
            $table->string('id_opd', 20);
            $table->string('jabatan_fungsional', 255);
            $table->enum('jenjang', ['Pertama', 'Muda', 'Madya', 'Utama']);
            $table->integer('kebutuhan');
            $table->integer('ketersediaan');
            $table->year('tahun');
            $table->timestamps();

            $table->foreign('id_opd')->references('id_opd')->on('opd')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('besetting_jf');
    }
};