@extends('layouts.dashboard')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Barang /</span> Edit Barang</h4>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('dashboard.barang.update', $barang->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kode Barang (Tetap)</label>
                        <input type="text" class="form-control bg-light" value="{{ $barang->kode_barang }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" value="{{ $barang->nama_barang }}"
                            required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori_id" class="form-select">
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $barang->kategori_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->nama }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Lokasi</label>
                        <select name="lokasi_id" class="form-select">
                            @foreach($locations as $loc)
                            <option value="{{ $loc->id }}" {{ $barang->lokasi_id == $loc->id ? 'selected' : '' }}>
                                {{ $loc->nama }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stok" class="form-control" value="{{ $barang->stok }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kondisi</label>
                        <select name="kondisi" class="form-select">
                            <option value="Baik" {{ $barang->kondisi == 'Baik' ? 'selected' : '' }}>Baik</option>
                            <option value="Rusak Ringan" {{ $barang->kondisi == 'Rusak Ringan' ? 'selected' : ''
                                }}>Rusak Ringan</option>
                            <option value="Rusak Berat" {{ $barang->kondisi == 'Rusak Berat' ? 'selected' : '' }}>Rusak
                                Berat</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success">Update Barang</button>
                    <a href="{{ route('dashboard.barang.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection