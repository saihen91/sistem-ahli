<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anggota extends Model
{
    use HasFactory;
    
    protected $table = 'anggotas';

    protected $fillable = [
        'no_anggota',
        'nama',
        'ic',
        'alamat',
        'no_tel',
        'status',
    ];

    // 1 anggota ada banyak bayaran
    public function bayaran()
    {
        return $this->hasMany(Bayaran::class);
    }

    // 1 anggota ada banyak resit
    public function resit()
    {
        return $this->hasMany(Resit::class);
    }
}
