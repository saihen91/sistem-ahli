<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resit extends Model
{
    protected $table = 'resits';

    protected $fillable = [
        'no_resit',
        'anggota_id',
        'bayaran_id',
        'tarikh',
        'jumlah',
    ];

    // Resit milik anggota
    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    // Resit milik bayaran
    public function bayaran()
    {
        return $this->belongsTo(Bayaran::class);
    }
}
