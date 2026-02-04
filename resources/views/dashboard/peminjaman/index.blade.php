@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between mb-4">
        <h1 class="h3">Daftar Peminjaman</h1>
        <a href="{{ route('dashboard.peminjaman.create') }}" class="btn btn-primary">Input Pinjaman Baru</a>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Peminjam</th>
                        <th>Tanggal Pinjam</th>
                        <th>Status</th>
                        <th>Petugas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjaman as $p)
                    <tr>
                        <td>{{ $p->kode_peminjaman }}</td>
                        <td>{{ $p->nama_peminjam }} ({{ $p->jenis_peminjam }})</td>
                        <td>{{ $p->tanggal_pinjam }}</td>
                        <td><span class="badge badge-warning">{{ $p->status }}</span></td>
                        <td>{{ $p->user->name }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info">Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection