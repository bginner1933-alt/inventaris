@extends('layouts.dashboard')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    /* Styling Card Utama */
    .inventory-card {
        border: none;
        border-radius: 20px;
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .inventory-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
    }

    /* Gradient Backgrounds sesuai konteks Inventaris */
    .bg-items {
        background: linear-gradient(135deg, #696cff 0%, #4e51d8 100%) !important;
    }

    .bg-categories {
        background: linear-gradient(135deg, #03c3ec 0%, #0294b3 100%) !important;
    }

    .bg-locations {
        background: linear-gradient(135deg, #71dd37 0%, #54a429 100%) !important;
    }

    .bg-loans {
        background: linear-gradient(135deg, #ffab00 0%, #cc8900 100%) !important;
    }

    /* Icon Styling */
    .icon-circle {
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    /* Table Customization */
    .table-hover tbody tr:hover {
        background-color: rgba(105, 108, 255, 0.03);
    }

    .status-badge {
        padding: 5px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
    }
</style>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up">
            <div class="card inventory-card bg-items text-white shadow">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            {{-- Ubah teks label di sini --}}
                            <h6 class="text-white-50 mb-1">Total Jumlah Barang</h6>
                            <h2 class="text-white fw-bold mb-0">{{ number_format($totalBarang) }}</h2>
                        </div>
                        <div class="icon-circle">
                            <i class="bx bx-package"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card inventory-card bg-categories text-white shadow">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 mb-1">Kategori</h6>
                            <h2 class="text-white fw-bold mb-0">{{ $totalKategori }}</h2>
                        </div>
                        <div class="icon-circle">
                            <i class="bx bx-category"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card inventory-card bg-locations text-white shadow">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 mb-1">Titik Lokasi</h6>
                            <h2 class="text-white fw-bold mb-0">{{ $totalLokasi }}</h2>
                        </div>
                        <div class="icon-circle">
                            <i class="bx bx-map-pin"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
            <div class="card inventory-card bg-loans text-white shadow">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 mb-1">Peminjaman Aktif</h6>
                            <h2 class="text-white fw-bold mb-0">{{ $peminjamanAktif }}</h2>
                        </div>
                        <div class="icon-circle">
                            <i class="bx bx-receipt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12" data-aos="fade-up" data-aos-delay="400">
            <div class="card inventory-card shadow-sm bg-white">
                <div class="card-header border-bottom d-flex justify-content-between align-items-center bg-transparent">
                    <h5 class="mb-0 fw-bold"><i class="bx bx-history me-2 text-primary"></i>Aktivitas Peminjaman Terbaru
                    </h5>
                    <a href="{{ route('dashboard.peminjaman.index') }}"
                        class="btn btn-outline-primary btn-sm rounded-pill px-3">
                        Lihat Semua
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="py-3">Nama Peminjam</th>
                                <th class="py-3">Barang</th>
                                <th class="py-3">Lokasi Asal</th>
                                <th class="py-3 text-center">Status</th>
                                <th class="py-3">Tgl Pinjam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($riwayatTerbaru as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar flex-shrink-0 me-3">
                                            <span class="avatar-initial rounded-circle bg-label-primary">
                                                <i class="bx bx-user"></i>
                                            </span>
                                        </div>
                                        {{-- Nama peminjam yang diinput di form --}}
                                        <span class="fw-bold">{{ $item->nama_peminjam }}</span>
                                    </div>
                                </td>
                                <td>
                                    {{-- PERBAIKAN: Mengambil barang lewat relasi detail --}}
                                    <span class="text-muted">
                                        {{ $item->detail->barang->nama_barang ?? 'Barang Terhapus' }}
                                    </span>
                                </td>
                                <td>
                                    {{-- PERBAIKAN: Mengambil lokasi dari relasi barang --}}
                                    {{ $item->detail->barang->lokasi->nama ?? 'N/A' }}
                                </td>
                                <td class="text-center">
                                    @if($item->status == 'dipinjam')
                                    <span class="status-badge bg-label-warning text-warning">DIPINJAM</span>
                                    @else
                                    <span class="status-badge bg-label-success text-success">KEMBALI</span>
                                    @endif
                                </td>
                                {{-- Menggunakan format tanggal pinjam dari database --}}
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">Belum ada aktivitas peminjaman.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({ duration: 800, once: true });
    });
</script>
@endsection