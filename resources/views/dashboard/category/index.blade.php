@extends('layouts.dashboard')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold py-3 mb-0">
            <span class="text-muted fw-light">Manajemen /</span> Kategori
        </h4>
        <a href="{{ route('dashboard.category.create') }}" class="btn btn-primary">
            <i class="bx bx-plus me-1"></i> Tambah Kategori
        </a>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Tabel Kategori --}}
    <div class="card shadow-sm border-0">
        <h5 class="card-header fw-bold">Daftar Kategori Terdaftar</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th class="py-3" width="5%">No</th>
                        <th class="py-3" width="10%">Foto</th>
                        <th class="py-3">Nama Kategori</th>
                        <th class="py-3">Jumlah Produk</th>
                        <th class="text-center py-3" width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($categories as $category)
                        <tr>
                            <td class="py-3"><strong>#{{ $loop->iteration }}</strong></td>
                            
                            {{-- Kolom Foto --}}
                            <td class="py-3">
                                <div class="avatar avatar-md">
                                    @if ($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}" 
                                             alt="{{ $category->name }}" 
                                             style="width: 50px; height: 50px; object-fit: cover;"
                                             class="rounded shadow-sm"
                                             onerror="this.src='https://placehold.co/50x50?text=KOSONG'">
                                    @else
                                        <span class="avatar-initial rounded bg-label-secondary">
                                            <i class="bx bx-image-alt"></i>
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <td class="py-3">
                                <span class="fw-semibold text-dark">{{ $category->name }}</span>
                            </td>

                            {{-- Jumlah Produk --}}
                            <td class="py-3">
                                <span class="badge bg-label-primary">
                                    {{ $category->products->count() ?? 0 }} Produk
                                </span>
                            </td>

                            {{-- Aksi --}}
                            <td class="text-center py-3">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded fs-4 text-muted"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item text-primary" href="{{ route('dashboard.category.show', $category->id) }}">
                                            <i class="bx bx-show-alt me-1"></i> Lihat Detail
                                        </a>
                                        <a class="dropdown-item text-warning" href="{{ route('dashboard.category.edit', $category->id) }}">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <form action="{{ route('dashboard.category.destroy', $category->id) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="bx bx-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bx bx-folder-open fs-1 d-block mb-2"></i>
                                    Data kategori masih kosong
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
