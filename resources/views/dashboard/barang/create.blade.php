@extends('layouts.dashboard')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Barang /</span> Tambah Baru</h4>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('dashboard.barang.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kode Barang</label>
                        <input type="text" name="kode_barang" class="form-control"
                            value="BRG-{{ strtoupper(Str::random(5)) }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" required
                            placeholder="Contoh: Laptop ThinkPad">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori_id" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Lokasi / Ruangan</label>
                        <select name="lokasi_id" class="form-select" required>
                            <option value="">-- Pilih Lokasi --</option>
                            @foreach($locations as $loc)
                            <option value="{{ $loc->id }}">{{ $loc->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stok" class="form-control" min="0" value="0">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Satuan</label>
                        <input type="text" name="satuan" class="form-control" placeholder="Pcs/Unit/Set">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Kondisi</label>
                        <select name="kondisi" class="form-select">
                            <option value="Baik">Baik</option>
                            <option value="Rusak Ringan">Rusak Ringan</option>
                            <option value="Rusak Berat">Rusak Berat</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary me-2">Simpan Barang</button>
                    <a href="{{ route('dashboard.barang.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection