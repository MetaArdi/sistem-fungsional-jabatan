<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogIntegrasi extends Model
{
    protected $table = 'log_integrasi';
    
    protected $fillable = [
        'id_usulan',
        'id_sk',
        'aksi',
        'status',
        'response',
        'id_user'
    ];

    public function usulan()
    {
        return $this->belongsTo(Usulan::class, 'id_usulan', 'id');
    }

    public function sk()
    {
        return $this->belongsTo(SK::class, 'id_sk', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}