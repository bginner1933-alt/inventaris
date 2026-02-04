@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('dashboard.kategori.index') }}" class="btn btn-sm btn-secondary mr-3">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <h1 class="h3 mb-0 text-gray-800">Detail Kategori: {{ $kategori->nama }}</h1>
    </div>

    <div class="row">
        <div class="col-xl-4 col-md-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Kategori</h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        @if($kategori->image)
                        <img src="{{ asset('storage/' . $kategori->image) }}" class="img-fluid rounded shadow-sm"
                            style="max-height: 200px;">
                        @else
                        <div class="bg-light rounded py-5">
                            <i class="fas fa-folder fa-4x text-gray-300"></i>
                            <p class="mt-2 text-gray-500">Tidak ada foto</p>
                        </div>
                        @endif
                    </div>
                    <h5>{{ $kategori->nama }}</h5>
                    <p class="text-muted">{{ $kategori->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                    <hr>
                    <div class="small">
                        <strong>Total Barang:</strong> {{ $kategori->barangs->count() }} unit<br>
                        <strong>Dibuat pada:</strong> {{ $kategori->created_at->format('d M Y') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-md-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Barang dalam Kategori Ini</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="bg-light">
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Barang</th>
                                    <th>Stok</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kategori->barangs as $barang)
                                <tr>
                                    <td>{{ $barang->kode_barang ?? '-' }}</td>
                                    <td><strong>{{ $barang->nama_barang }}</strong></td>
                                    <td>{{ $barang->stok }}</td>
                                    <td>
                                        @if($barang->stok > 0)
                                        <span class="badge badge-success">Tersedia</span>
                                        @else
                                        <span class="badge badge-danger">Habis</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">Belum ada barang dalam kategori
                                        ini.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection