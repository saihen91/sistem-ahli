@extends('layouts.app')

@section('content')

<div class="card mb-4">
    <div class="card-body">
        <h4>{{ $anggota->nama }}</h4>
        <p>IC: {{ $anggota->ic }}</p>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">Bayaran</div>
    <div class="card-body">

        <form action="{{ route('bayaran.store') }}" method="POST">
            @csrf
            <input type="hidden" name="anggota_id" value="{{ $anggota->id }}">

            <div class="row">
                <div class="col">
                    <input type="number" name="bulan" class="form-control" placeholder="Bulan">
                </div>
                <div class="col">
                    <input type="number" name="tahun" class="form-control" placeholder="Tahun">
                </div>
                <div class="col">
                    <input type="text" name="jumlah" class="form-control" placeholder="Jumlah">
                </div>
            </div>

            <button class="btn btn-primary mt-3">Bayar</button>
        </form>

    </div>
</div>

<div class="card">
    <div class="card-header">Sejarah Bayaran</div>
    <div class="card-body">

        <a href="{{ route('anggota.statement', $anggota->id) }}" 
        class="btn btn-primary mb-3">
            Print Statement PDF
        </a>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Jumlah</th>
                    <th>Resit</th>
                </tr>
            </thead>

            <tbody>
                @forelse($anggota->bayaran as $b)
                <tr>
                    <td>{{ $b->bulan }}</td>
                    <td>{{ $b->tahun }}</td>
                    <td>RM {{ number_format($b->jumlah, 2) }}</td>
                    <td>
                        <a href="{{ route('resit.print', $b->resit->id) }}" class="btn btn-sm btn-secondary" target="_blank">
                            Print
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Tiada bayaran</td>
                </tr>
                @endforelse
            </tbody>

        </table>

    </div>
</div>

@endsection
