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

   protected static function booted()
        {
            static::addGlobalScope('cabang', function ($query) {
                if (auth()->check()) {

                    $role = auth()->user()->role;
                    $cab  = auth()->user()->cab_code;

                    // hanya user biasa yang dibatasi
                    if ($role === 'user') {
                        $query->where('cab_code', $cab);
                    }

                }
            });
        }

    public function details()
    {
        return $this->hasMany(PengajuanDetail::class, 'kas_bukti_no', 'kas_bukti_no');
    }

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'cab_code', 'cab_code');
    }
}
