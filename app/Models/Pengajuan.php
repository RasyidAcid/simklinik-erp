<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $fillable = [
        'kas_bukti_no',
        'kas_bukti_date',
        'pj_code',
        'kas_keperluan',
        'kas_notes',
        'user_login',
        'update_ip',
    ];

    public function details()
    {
        return $this->hasMany(PengajuanDetail::class, 'kas_bukti_no', 'kas_bukti_no');
    }
}
