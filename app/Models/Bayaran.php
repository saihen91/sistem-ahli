<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bayaran extends Model
{
    protected $table = 'bayarans';

    protected $fillable = [
        'anggota_id',
        'jumlah',
        'bulan',
        'tahun',
        'tarikh_bayar',
        'kaedah',
    ];

    // Bayaran milik anggota
    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    // 1 bayaran ada 1 resit
    public function resit()
    {
        return $this->hasOne(Resit::class);
    }
}
