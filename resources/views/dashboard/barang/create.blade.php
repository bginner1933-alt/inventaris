@extends('layouts.dashboard')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Barang /</span> Tambah Baru
    </h4>

    <div class="card">
        <div class="card-body">

            {{-- TAMPILKAN ERROR VALIDASI --}}
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('dashboard.barang.store') }}" method="POST">
                @csrf

                {{-- KODE & NAMA --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kode Barang</label>
                        <input type="text" name="kode_barang" class="form-control"
                            value="BRG-{{ strtoupper(Str::random(5)) }}" readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang') }}"
                            required>
                    </div>
                </div>

                {{-- KATEGORI & LOKASI --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori_id" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('kategori_id')==$cat->id ? 'selected' : '' }}>
                                {{ $cat->nama }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Lokasi / Ruangan</label>
                        <select name="lokasi_id" class="form-select" required>
                            <option value="">-- Pilih Lokasi --</option>
                            @foreach($locations as $loc)
                            <option value="{{ $loc->id }}" {{ old('lokasi_id')==$loc->id ? 'selected' : '' }}>
                                {{ $loc->nama }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- STOK, SATUAN, KONDISI --}}
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stok" class="form-control" min="0" value="{{ old('stok', 0) }}"
                            required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Satuan</label>
                        <input type="text" name="satuan" class="form-control" value="{{ old('satuan') }}" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Kondisi</label>
                        <select name="kondisi" class="form-select" required>
                            <option value="">-- Pilih Kondisi --</option>
                            <option value="baik" {{ old('kondisi')=='baik' ? 'selected' : '' }}>Baik</option>
                            <option value="rusak_ringan" {{ old('kondisi')=='rusak_ringan' ? 'selected' : '' }}>Rusak
                                Ringan</option>
                            <option value="rusak_berat" {{ old('kondisi')=='rusak_berat' ? 'selected' : '' }}>Rusak
                                Berat</option>
                            <option value="hilang" {{ old('kondisi')=='hilang' ? 'selected' : '' }}>Hilang</option>
                        </select>
                    </div>
                </div>

                {{-- TANGGAL BELI & HARGA --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Beli</label>
                        <input type="date" name="tanggal_beli" class="form-control" value="{{ old('tanggal_beli') }}"
                            required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" name="harga" class="form-control" min="0" step="0.01"
                            value="{{ old('harga') }}" required>
                    </div>
                </div>

                {{-- TOMBOL --}}
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary me-2">
                        Simpan Barang
                    </button>
                    <a href="{{ route('dashboard.barang.index') }}" class="btn btn-outline-secondary">
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection