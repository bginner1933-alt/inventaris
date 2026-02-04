@extends('layouts.dashboard')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold py-3 mb-0">
            <span class="text-muted fw-light">Manajemen /</span> Produk
        </h4>
        <a href="{{ route('dashboard.product.create') }}" class="btn btn-primary">
            <i class="bx bx-plus me-1"></i> Tambah Produk
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <h5 class="card-header">Daftar Produk Terdaftar</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th class="py-3">ID</th> {{-- Tambah padding di header --}}
                        <th class="py-3">Nama Produk</th>
                        <th class="py-3">Harga</th>
                        <th class="py-3">Kategori</th>
                        <th class="text-center py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($products as $product)
                    <tr>
                        {{-- Gunakan py-4 untuk membuat baris sangat lega/tinggi ke bawah --}}
                        <td class="py-4"><strong>#{{ $product->id }}</strong></td>
                        <td class="py-4">
                            <span class="fw-bold text-dark">{{ $product->name }}</span>
                        </td>
                        <td class="py-4">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="py-4">
                            <span class="badge bg-label-info me-1">
                                {{ $product->category->name ?? 'Tanpa Kategori' }}
                            </span>
                        </td>
                        <td class="text-center py-4">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded bx-sm"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('dashboard.product.edit', $product->id) }}">
                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                    </a>
                                    <a class="dropdown-item" href="{{ route('dashboard.product.show', $product->id) }}">
                                        <i class="bx bx-show-alt me-1"></i> Show
                                    </a>
                                    <form action="{{ route('dashboard.product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin?')">
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
                            <div class="text-muted">Belum ada data produk tersedia.</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection