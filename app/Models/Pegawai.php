<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';
    protected $primaryKey = 'nip';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nip', 
        'no_sertifikat',
        'masa_berlaku_sertifikat',
        'tahun_predikat_kinerja',
        'nama_lengkap', 
        'tempat_lahir', 
        'tanggal_lahir', 
        'jenis_kelamin', 
        'agama', 
        'status_perkawinan', 
        'alamat', 
        'no_hp', 
        'email', 
        'id_opd', 
        'pangkat', 
        'golongan', 
        'tmt_pangkat', 
        'jabatan_saat_ini', 
        'unit_kerja', 
        'angka_kredit', 
        'usia_tahun', 
        'usia_bulan', 
        'pendidikan_terakhir', 
        'jurusan', 
        'tahun_lulus',
        'status_aktif',
    ];

    public function opd()
    {
        return $this->belongsTo(OPD::class, 'id_opd', 'id_opd');
    }
}