@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Lokasi Baru</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('dashboard.location.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Lokasi</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                        value="{{ old('nama') }}" required>
                    @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi') }}</textarea>
                </div>
                <hr>
                <a href="{{ route('dashboard.location.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-warning"><a href="{{ route('dashboard.location.index') }}">Simpan Lokasi</a></button>
            </form>
        </div>
    </div>
</div>
@endsection