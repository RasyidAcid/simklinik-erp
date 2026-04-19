<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
      protected $table = 'rekenings'; // pastikan sesuai migration

    protected $fillable = [
        'kode_rekening',
        'nama_rekening'
    ];
}
