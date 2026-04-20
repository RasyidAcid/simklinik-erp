<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KodePengajuan extends Model
{
    protected $fillable = [
        'pj_code',
        'pj_sub_code',
        'pj_name',
        'cab_code',
        'usaha_code',
        'gud_code',
        'saldo',
        'update_ip',
    ];
}
