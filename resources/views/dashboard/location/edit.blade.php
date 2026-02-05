@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Lokasi: {{ $location->nama }}</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('dashboard.location.update', $location->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Nama Lokasi</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $location->nama) }}"
                        required>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control"
                        rows="4">{{ old('deskripsi', $location->deskripsi) }}</textarea>
                </div>
                <hr>
                <a href="{{ route('dashboard.location.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-info">Update Data</button>
            </form>
        </div>
    </div>
</div>
@endsection