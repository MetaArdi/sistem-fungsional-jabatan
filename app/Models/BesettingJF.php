<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BesettingJF extends Model
{
    protected $table = 'besetting_jf';
    
    protected $fillable = [
        'opd_id',
        'jabatan_fungsional',
        'jenjang',
        'kebutuhan',
        'ketersediaan',
        'tahun'
    ];

    public function opd()
    {
        return $this->belongsTo(OPD::class, 'opd_id', 'id_opd');
    }
}