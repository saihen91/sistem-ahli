<?php

namespace App\Services;

use App\Models\Bayaran;
use App\Models\Resit;
use Carbon\Carbon;

class BayaranService
{
    public function createBayaran($data)
    {
        return \App\Models\Bayaran::create($data);
        // 1. check duplicate createBayaran
        $exists =  Bayaran::where('anggota_id', $data['anggota_id'])
            ->where('bulan', $data['bulan'])
            ->where('tahun', $data['tahun'])
            ->exists();

        // if ($exists) {
        //     throw new \Exeption("Bayaran untuk bulan ini sudah wujud.");
        // }

        // 2. create bayaran
        $bayaran = Bayaran::create($data);

        // 3. Generate no resit
        $no_resit = 'R' . date('Ymd') . rand(1000, 9999);

        // 4. Create resit
        Resit::create([
            'no_resit' => $no_resit,
            'anggota_id' => $data['anggota_id'],
            'bayaran_id' => $bayaran->id,
            'tarikh' => Carbon::now(),
            'jumlah' => $data['jumlah'],
        ]);

        return $bayaran;
    }
}