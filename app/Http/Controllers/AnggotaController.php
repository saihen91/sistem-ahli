<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Anggota;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $anggota = Anggota::when($search, function ($query, $search) {
                $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('ic', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('anggota.index', compact('anggota', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('anggota.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required',
                'ic' => 'required|unique:anggotas',
            ]
        );

        $anggota = Anggota::create([
            'no_anggota' => 'AG' . rand(1000, 9999),
            'nama' => $request->nama,
            'ic' => $request->ic,
            'no_tel' => $request->no_tel
        ]);

        return redirect()->route('anggota.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $anggota = Anggota::with(['bayaran' => function($q) {
            $q->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc');
        }, 'bayaran.resit'])->findOrFail($id);

        return view('anggota.show', compact('anggota'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('anggota.edit', compact('anggota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $anggota = Anggota::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'ic' => 'required|unique:anggotas,ic,' . $id,
        ]);

        $anggota->update([
            'nama' => $request->nama,
            'ic' => $request->ic,
            'no_tel' => $request->no_tel,
        ]);

        return redirect()->route('anggota.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $anggota = Anggota::findOrFail($id);
        $nama = $anggota->nama;

        $anggota->delete();

        return redirect()->route('anggota.index')
            ->with('success', 'Data berjaya dipadam');
    }

    public function statement($id)
    {
        $anggota = Anggota::with('bayaran')->findOrFail($id);

        $totalBayaran = $anggota->bayaran->sum('jumlah');

        $pdf = Pdf::loadView('anggota.statement_pdf', [
            'anggota' => $anggota,
            'totalBayaran' => $totalBayaran
        ]);

        return $pdf->download('statement_'.$anggota->no_anggota.'.pdf');
    }
}
