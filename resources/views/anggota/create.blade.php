@extends('layouts.app')

@section('content')

<h3>Tambah Ahli</h3>

<form action="{{ route('anggota.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control">
    </div>

    <div class="mb-3">
        <label>IC</label>
        <input type="text" name="ic" class="form-control">
    </div>

    <div class="mb-3">
        <label>No Tel</label>
        <input type="text" name="no_tel" class="form-control">
    </div>

    <button class="btn btn-success">Simpan</button>
</form>

@endsection
