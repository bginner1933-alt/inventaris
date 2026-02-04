@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Kategori</h1>
        <a href="{{ route('dashboard.kategori.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Kategori
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success border-left-success shadow animated--grow-in">
        {{ session('success') }}
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" width="50"
                                    class="img-profile rounded">
                                @else
                                <div class="text-xs font-weight-bold text-secondary">N/A</div>
                                @endif
                            </td>
                            <td><strong>{{ $item->nama }}</strong></td>
                            <td>{{ Str::limit($item->deskripsi, 50) }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('dashboard.kategori.edit', $item->id) }}"
                                        class="btn btn-sm btn-info mr-2">Edit</a>
                                    <form action="{{ route('dashboard.kategori.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection