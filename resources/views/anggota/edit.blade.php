@extends('layouts.app')

@section('content')

<h3>Edit Ahli</h3>

<form action="{{ route('anggota.update', $anggota->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" value="{{ $anggota->nama }}">
    </div>

    <div class="mb-3">
        <label>IC</label>
        <input type="text" name="ic" class="form-control" value="{{ $anggota->ic }}">
    </div>

    <div class="mb-3">
        <label>No Tel</label>
        <input type="text" name="no_tel" class="form-control" value="{{ $anggota->no_tel }}">
    </div>

    <button class="btn btn-success">Update</button>
</form>

@endsection
