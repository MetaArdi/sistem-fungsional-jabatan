<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BahanRapat extends Model
{
    protected $table = 'bahan_rapat';
    
    protected $fillable = [
        'nomor_bahan', 'tanggal_bahan', 'no_urut', 
        'kajian_otomatis', 'tabel_besetting', 'status_bahan',
        'alasan_persetujuan', 'disetujui_oleh', 'tanggal_disetujui'
    ];
    
    // Relasi ke usulan (many-to-many)
    public function usulan()
    {
        return $this->belongsToMany(Usulan::class, 'bahan_rapat_usulan', 'id_bahan_rapat', 'id_usulan')
                    ->withPivot('id')
                    ->withTimestamps();
    }
    
    public function disetujuiOleh()
    {
        return $this->belongsTo(User::class, 'disetujui_oleh');
    }
}