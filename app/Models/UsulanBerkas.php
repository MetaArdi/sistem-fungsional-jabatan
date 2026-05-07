<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsulanBerkas extends Model
{
    protected $table = 'usulan_berkas';
    protected $fillable = ['id_usulan', 'jenis_berkas', 'nama_file', 'path_file'];
    
    public function usulan()
    {
        return $this->belongsTo(Usulan::class, 'id_usulan');
    }
}