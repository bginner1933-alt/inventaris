@extends('layouts.dashboard')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Barang /</span> Detail Produk</h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Informasi Barang: {{ $barang->kode_barang }}</h5>
                    <a href="{{ route('dashboard.barang.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3 fw-bold">Nama Barang</div>
                        <div class="col-sm-9">: {{ $barang->nama_barang }}</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3 fw-bold">Kategori</div>
                        <div class="col-sm-9">: <span class="badge bg-label-primary">{{ $barang->kategori->nama ?? '-'
                                }}</span></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3 fw-bold">Lokasi</div>
                        <div class="col-sm-9">: {{ $barang->lokasi->nama ?? '-' }}</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3 fw-bold">Stok & Satuan</div>
                        <div class="col-sm-9">: {{ $barang->stok }} {{ $barang->satuan }}</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3 fw-bold">Kondisi Saat Ini</div>
                        <div class="col-sm-9">:
                            <span class="badge {{ $barang->kondisi == 'Baik' ? 'bg-success' : 'bg-warning' }}">
                                {{ $barang->kondisi }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection