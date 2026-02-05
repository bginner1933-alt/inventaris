@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Detail Lokasi</h6>
            <a href="{{ route('dashboard.location.edit', $location->id) }}" class="btn btn-sm btn-info">Edit Lokasi</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th width="200px">ID Lokasi</th>
                    <td>#{{ $location->id }}</td>
                </tr>
                <tr>
                    <th>Nama Lokasi</th>
                    <td>{{ $location->nama }}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>{{ $location->deskripsi ?? 'Tidak ada deskripsi' }}</td>
                </tr>
                <tr>
                    <th>Dibuat Pada</th>
                    <td>{{ $location->created_at->format('d M Y H:i') }}</td>
                </tr>
            </table>
            <a href="{{ route('dashboard.location.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
        </div>
    </div>
</div>
@endsection