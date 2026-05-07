<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OPD extends Model
{
    protected $table = 'opd';
    protected $primaryKey = 'id_opd';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id_opd', 'kode_opd', 'nama_opd', 'alamat', 'telepon', 'email'];
}