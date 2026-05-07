<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatUsulan extends Model
{
    protected $table = 'riwayat_usulan';
    
    protected $fillable = [
        'id_usulan',
        'status',
        'keterangan',
        'id_user'
    ];

    public function usulan()
    {
        return $this->belongsTo(Usulan::class, 'id_usulan', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}