<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SK extends Model
{
    protected $table = 'sk';
    protected $fillable = ['id_usulan', 'nomor_sk', 'tanggal_sk', 'file_sk', 'status', 'keterangan'];

    public function usulan()
    {
        return $this->belongsTo(Usulan::class, 'id_usulan');
    }
}