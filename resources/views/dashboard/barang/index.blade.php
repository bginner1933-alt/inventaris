@extends('layouts.dashboard')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold py-3 mb-0">
            <span class="text-muted fw-light">Manajemen /</span> Barang
        </h4>
        {{-- SESUAIKAN: dari product.create ke barang.create --}}
        <a href="{{ route('dashboard.barang.create') }}" class="btn btn-primary">
            <i class="bx bx-plus me-1"></i> Tambah Barang
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card">
        <h5 class="card-header">Daftar Barang Terdaftar</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th class="py-3">Kode</th>
                        <th class="py-3">Nama Barang</th>
                        <th class="py-3">Stok</th>
                        <th class="py-3">Kategori</th>
                        <th class="text-center py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    {{-- SESUAIKAN: variabel dari $products ke $barangs --}}
                    @forelse($barangs as $barang)
                    <tr>
                        <td class="py-4"><strong>{{ $barang->kode_barang }}</strong></td>
                        <td class="py-4">
                            <span class="fw-bold text-dark">{{ $barang->nama_barang }}</span>
                        </td>
                        <td class="py-4">{{ $barang->jumlah }}</td>
                        <td class="py-4">
                            <span class="badge bg-label-info me-1">
                                {{ $barang->kategori->nama ?? 'Tanpa Kategori' }}
                            </span>
                        </td>
                        <td class="text-center py-4">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded bx-sm"></i>
                                </button>
                                <div class="dropdown-menu">
                                    {{-- SESUAIKAN: Semua rute ke barang.* --}}
                                    <a class="dropdown-item" href="{{ route('dashboard.barang.edit', $barang->id) }}">
                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                    </a>
                                    <a class="dropdown-item" href="{{ route('dashboard.barang.show', $barang->id) }}">
                                        <i class="bx bx-show-alt me-1"></i> Show
                                    </a>
                                    <form action="{{ route('dashboard.barang.destroy', $barang->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bx bx-trash me-1"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="text-muted">Belum ada data barang tersedia.</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection