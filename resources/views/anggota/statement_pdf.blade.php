<!DOCTYPE html>
<html>
<head>
    <title>Statement Ahli</title>
    <style>
        body { font-family: sans-serif; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
    </style>
</head>
<body>

<h2>Statement Ahli</h2>

<p><b>Nama:</b> {{ $anggota->nama }}</p>
<p><b>No Ahli:</b> {{ $anggota->no_anggota }}</p>
<p><b>IC:</b> {{ $anggota->ic }}</p>

<h3>Senarai Transaksi</h3>

<table>
    <thead>
        <tr>
            <th>Tarikh</th>
            <th>Bulan</th>
            <th>Jumlah (RM)</th>
            <th>Kaedah</th>
        </tr>
    </thead>

    <tbody>
        @foreach($anggota->bayaran as $bayar)
        <tr>
            <td>{{ $bayar->created_at->format('d/m/Y') }}</td>
            <td>{{ $bayar->bulan }}</td>
            <td>RM {{ number_format($bayar->jumlah, 2) }}</td>
            <td>{{ $bayar->kaedah }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h3>Total: RM {{ number_format($totalBayaran, 2) }}</h3>

</body>
</html>
