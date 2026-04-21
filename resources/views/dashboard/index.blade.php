@extends('layouts.app')

@section('content')

<h3 class="mb-4">Dashboard</h3>

<div class="row">

    <div class="col-md-3">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5>Total Ahli</h5>
                <h3>{{ $totalAhli }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5>Total Bayaran</h5>
                <h3>RM {{ number_format($totalBayaran, 2) }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-warning mb-3">
            <div class="card-body">
                <h5>Total Resit</h5>
                <h3>{{ $totalResit }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-danger mb-3">
            <div class="card-body">
                <h5>Bulan Ini</h5>
                <h3>RM {{ number_format($bayaranBulanIni, 2) }}</h3>
            </div>
        </div>
    </div>

</div>


<form method="GET" action="{{ route('dashboard') }}" class="mb-3">
    <div class="row">
        <div class="col-md-3">

            <select name="year" class="form-control" onchange="this.form.submit()">

                @for($i = date('Y'); $i >= date('Y') - 5; $i--)
                    <option value="{{ $i }}" {{ ($selectedYear == $i) ? 'selected' : '' }}>
                        {{ $i }}
                    </option>
                @endfor

            </select>

        </div>
    </div>
</form>


<div class="card mt-4">
    <div class="card-body">
        <h5>Bayaran Bulanan</h5>
        <canvas id="bayaranChart"></canvas>
    </div>
</div>


<div class="card mt-4 mb-4">
    <div class="card-body">

        <h5>Top 5 Ahli Paling Banyak Bayar</h5>

        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Nama</th>
                    <th>Total Bayaran (RM)</th>
                </tr>
            </thead>

            <tbody>
                @foreach($topAhli as $key => $data)
                    <tr class="{{ $key == 0 ? 'table-success' : '' }}">
                        <td><span class="badge bg-primary">{{ $key + 1 }}</span></td>
                        <td>{{ $data->anggota->nama ?? '-' }}</td>
                        <td>RM {{ number_format($data->total_bayaran, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>


{{-- CHART --}}
<script>
const ctx = document.getElementById('bayaranChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: @json($months),
        datasets: [{
            label: 'Jumlah Bayaran (RM) - {{ $selectedYear }}',
            data: @json($amounts),
            backgroundColor: 'rgba(54, 162, 235, 0.6)',
        }]
    }
});
</script>


@endsection
