<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanDetail extends Model
{
    protected $fillable = [
        'kas_bukti_no',
        'bar_name',
        'kas_jumlah',
        'kas_nilai',
        'kas_total',
    ];

    public function header()
    {
        return $this->belongsTo(Pengajuan::class, 'kas_bukti_no', 'kas_bukti_no');
    }
}
