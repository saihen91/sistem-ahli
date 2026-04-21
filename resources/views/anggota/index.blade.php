@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Senarai Ahli</h3>
    <a href="{{ route('anggota.create') }}" class="btn btn-primary">
        + Tambah Ahli
    </a>
</div>

<form method="GET" action="{{ route('anggota.index') }}" class="mb-3">
    <div class="row">
        <div class="col-md-4">
            <input 
                type="text" 
                name="search" 
                value="{{ $search }}" 
                class="form-control" 
                placeholder="Search nama / IC">
        </div>

        <div class="col-auto">
            <button class="btn btn-primary">Search</button>
            <a href="{{ route('anggota.index') }}" class="btn btn-secondary">Reset</a>
        </div>
    </div>
</form>

@if($anggota->isEmpty())
    <div class="alert alert-warning">
        Tiada data dijumpai
    </div>
@endif

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>IC</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($anggota as $a)
        <tr>
            <td>{{ $a->no_anggota }}</td>
            <td>{!! str_replace($search, "<strong>$search</strong>", $a->nama) !!}</td>
            <td>{{ $a->ic }}</td>
            <td>
                <a href="{{ route('anggota.show', $a->id) }}" class="btn btn-sm btn-info">View</a>
                <a href="{{ route('anggota.edit', $a->id) }}" class="btn btn-sm btn-warning">Edit</a>

                <form action="{{ route('anggota.destroy', $a->id) }}" method="POST" class="d-inline delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-sm btn-danger btn-delete">
                        Delete
                    </button>
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $anggota->appends(['search' => $search])->links() }}

@endsection
