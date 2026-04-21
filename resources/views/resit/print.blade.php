<!DOCTYPE html>
<html>
<head>
    <title>Resit</title>
    <style>
        body {
            font-family: Arial;
        }
        .resit {
            width: 300px;
            margin: auto;
            border: 1px solid #000;
            padding: 15px;
        }
        .center {
            text-align: center;
        }
        hr {
            border: 1px dashed #000;
        }
    </style>
</head>
<body onload="window.print()">

<div class="resit">
    <div class="center">
        <h3>RESIT BAYARAN</h3>
        <p>No: {{ $resit->no_resit }}</p>
    </div>

    <hr>

    <p><strong>Nama:</strong> {{ $resit->anggota->nama }}</p>
    <p><strong>Tarikh:</strong> {{ \Carbon\Carbon::parse($resit->tarikh)->format('d/m/Y') }}</p>

    <hr>

    <p><strong>Jumlah:</strong> RM {{ number_format($resit->jumlah, 2) }}</p>

    <hr>

    <div class="center">
        <p>Terima Kasih</p>
    </div>
</div>

</body>
</html>
