<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usulan extends Model
{
    protected $table = 'usulan';
    
    protected $fillable = [
        'nip',
        'id_opd_pengusul',
        'id_user_pengusul',
        'jenis_usulan',
        'jabatan_lama',
        'golongan_lama',
        'unit_kerja_lama',
        'jabatan_baru',
        'golongan_baru',
        'unit_kerja_tujuan',
        'angka_kredit_usulan',
        'alasan_perpindahan',
        'alasan_pemberhentian',
        'tanggal_efektif',
        'nomor_surat',
        'no_surat_panrb',
        'jenis_surat',
        'jumlah_bandel',
        'keterangan_surat',
        'file_surat_pengantar',
        'status',
        'status_berkas',
        'alasan_penolakan',
        'alasan_pembatalan',
        'tanggal_pembatalan',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip', 'nip');
    }

    public function berkas()
{
    return $this->hasMany(UsulanBerkas::class, 'id_usulan');
}
    public function opd()
    {
        return $this->belongsTo(OPD::class, 'id_opd_pengusul', 'id_opd');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user_pengusul');
    }
}