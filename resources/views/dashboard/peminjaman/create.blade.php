@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Input Peminjaman Baru</h6>
                </div>
                <div class="card-body">
                    @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('dashboard.peminjaman.store') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label>Nama Lengkap Peminjam</label>
                            <input type="text" name="nama_peminjam" class="form-control"
                                placeholder="Contoh: Rivan Kurniawan" required>
                        </div>

                        <div class="form-group mb-3">
                            <label>Jenis Peminjam</label>
                            <select name="jenis_peminjam" class="form-control">
                                <option value="Siswa">Siswa</option>
                                <option value="Guru">Guru/Staff</option>
                                <option value="Umum">Umum</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label>Barang yang Dipinjam</label>
                            <select name="barang_id" class="form-control" required>
                                <option value="">-- Pilih Barang (Stok Tersedia) --</option>
                                @foreach($barang as $b)
                                <option value="{{ $b->id }}">
                                    {{ $b->nama_barang }} | (Sisa Stok: {{ $b->stok }})
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Jumlah Pinjam</label>
                                <input type="number" name="jumlah" class="form-control" min="1" value="1" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Tanggal Pinjam</label>
                                <input type="date" name="tanggal_pinjam" class="form-control"
                                    value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label>Kondisi Barang (Awal)</label>
                            <textarea name="kondisi_sebelum" class="form-control" rows="2"
                                placeholder="Contoh: Barang dalam kondisi baru dan berfungsi baik"></textarea>
                        </div>

                        <hr>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save mr-1"></i> Simpan Peminjaman
                        </button>
                        <a href="{{ route('dashboard.peminjaman.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4 border-left-info">
                <div class="card-body">
                    <h5>Informasi</h5>
                    <p class="small text-muted">
                        Pastikan stok barang tersedia sebelum melakukan input. Sistem akan otomatis memotong jumlah stok
                        setelah formulir dikirim.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection