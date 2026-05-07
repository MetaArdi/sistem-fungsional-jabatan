<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Add new columns to usulan table
        Schema::table('usulan', function (Blueprint $table) {
            $table->enum('status_berkas', ['menunggu_verifikasi', 'valid', 'perlu_revisi', 'setelah_revisi'])->default('menunggu_verifikasi')->after('file_surat_pengantar');
            $table->text('alasan_pembatalan')->nullable()->after('alasan_penolakan');
            $table->date('tanggal_pembatalan')->nullable()->after('alasan_pembatalan');
        });

        // Update enum for jenis_usulan using DB statement
        DB::statement("ALTER TABLE usulan MODIFY COLUMN jenis_usulan ENUM('kenaikan', 'perpindahan', 'pemberhentian', 'promosi', 'mutasi', 'demosi')");
        
        // Migrate data
        DB::table('usulan')->where('jenis_usulan', 'kenaikan')->update(['jenis_usulan' => 'promosi']);
        DB::table('usulan')->where('jenis_usulan', 'perpindahan')->update(['jenis_usulan' => 'mutasi']);

        // Remove old enum values
        DB::statement("ALTER TABLE usulan MODIFY COLUMN jenis_usulan ENUM('promosi', 'mutasi', 'demosi', 'pemberhentian') NOT NULL");


        // Update enum for status using DB statement
        DB::statement("ALTER TABLE usulan MODIFY COLUMN status ENUM('menunggu_verifikasi', 'sedang_diverifikasi', 'ditolak_verifikator', 'menunggu_persetujuan', 'ditolak_administrasi', 'sk_diterbitkan', 'selesai', 'menunggu_verifikasi_berkas', 'revisi_berkas', 'menunggu_verifikasi_substansi', 'disetujui', 'ditolak', 'dibatalkan')");

        // Migrate data
        DB::table('usulan')->where('status', 'menunggu_verifikasi')->update(['status' => 'menunggu_verifikasi_berkas']);
        DB::table('usulan')->where('status', 'sedang_diverifikasi')->update(['status' => 'menunggu_verifikasi_substansi']);
        // If sk_diterbitkan, we can map to disetujui
        DB::table('usulan')->where('status', 'sk_diterbitkan')->update(['status' => 'disetujui']);
        DB::table('usulan')->where('status', 'selesai')->update(['status' => 'disetujui']);
        DB::table('usulan')->whereIn('status', ['ditolak_verifikator', 'ditolak_administrasi'])->update(['status' => 'ditolak']);

        // Remove old enum values
        DB::statement("ALTER TABLE usulan MODIFY COLUMN status ENUM('menunggu_verifikasi_berkas', 'revisi_berkas', 'menunggu_verifikasi_substansi', 'disetujui', 'ditolak', 'dibatalkan') NOT NULL DEFAULT 'menunggu_verifikasi_berkas'");
    }

    public function down()
    {
        // Revert columns
        Schema::table('usulan', function (Blueprint $table) {
            $table->dropColumn('status_berkas');
            $table->dropColumn('alasan_pembatalan');
            $table->dropColumn('tanggal_pembatalan');
        });

        // Revert enums... (omitted for brevity as rollback might lose data)
        DB::statement("ALTER TABLE usulan MODIFY COLUMN jenis_usulan ENUM('kenaikan', 'perpindahan', 'pemberhentian') NOT NULL");
        DB::statement("ALTER TABLE usulan MODIFY COLUMN status ENUM('menunggu_verifikasi', 'sedang_diverifikasi', 'ditolak_verifikator', 'menunggu_persetujuan', 'ditolak_administrasi', 'sk_diterbitkan', 'selesai') NOT NULL DEFAULT 'menunggu_verifikasi'");
    }
};
