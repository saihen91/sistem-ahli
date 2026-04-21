<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Bayaran;
use App\Models\Resit;

class BayaranController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'anggota_id' => 'required',
            'jumlah' => 'required|numeric',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer',
        ]);

        // tambah data default
        $data['tarikh_bayar'] = now();
        $data['kaedah'] = 'cash';

        try {
            DB::beginTransaction();

            // 1. Check duplicate
            $exists = Bayaran::where('anggota_id', $data['anggota_id'])
                ->where('bulan', $data['bulan'])
                ->where('tahun', $data['tahun'])
                ->exists();

            if ($exists) {
                return back()->with('error', 'Bayaran bulan ini sudah wujud.');
            }

            // 2. Save bayaran
            $bayaran = Bayaran::create($data);

            // 3. Generate no_resit (proper format: R-2026-0001)
            $tahun = date('Y');

            // ambil resit terakhir untuk tahun semasa
            $lastResit = Resit::whereYear('tarikh', $tahun)
                ->orderBy('id', 'desc')
                ->first();

            if ($lastResit) {
                // extract number (contoh: R-2026-0001 → 0001)
                $lastNumber = (int) substr($lastResit->no_resit, -4);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            // format jadi 4 digit
            $formattedNumber = str_pad($newNumber, 4, '0', STR_PAD_LEFT);

            // final no resit
            $no_resit = "R-$tahun-$formattedNumber";

            // 4. Create resit
            Resit::create([
                'no_resit' => $no_resit,
                'anggota_id' => $data['anggota_id'],
                'bayaran_id' => $bayaran->id,
                'tarikh' => now(),
                'jumlah' => $data['jumlah'],
            ]);

            DB::commit();

            $bayaran = Bayaran::create($request->all());

            audit_log('CREATE', 'Bayaran', 'Bayaran RM'.$bayaran->jumlah);

            return back()->with('success', 'Bayaran berjaya direkod.');

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
