@extends('layouts.dashboard')

@section('content')
<style>
    /* Custom Styles untuk Dashboard */
    .dashboard-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }

    .welcome-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 40px;
        border-radius: 15px;
        margin-bottom: 30px;
    }

    .stat-card {
        border-radius: 12px;
        padding: 20px;
        background: #fff;
        border-left: 5px solid #764ba2;
    }

    .icon-box {
        font-size: 2rem;
        color: #764ba2;
        opacity: 0.3;
        position: absolute;
        right: 20px;
        bottom: 10px;
    }
</style>

<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="welcome-section text-center shadow-sm">
                <h1 class="display-5 fw-bold">Halo, {{ Auth::user()->name }}!</h1>
                <p class="lead">Selamat Datang di Sistem Inventaris Rivan Gunawan</p>
                <hr class="my-4 opacity-25">
                <p>Kelola aset dan barang Anda dengan lebih efisien dan terorganisir.</p>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-2">
        @if (session('status'))
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <div class="col-md-4">
            <div class="card dashboard-card h-100 p-3">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-muted">Total Barang</h5>
                    <h2 class="fw-bold mt-2">0</h2>
                    <p class="text-success mb-0 small"><i class="bi bi-arrow-up"></i> Terupdate hari ini</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card dashboard-card h-100 p-3 border-start border-info">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-muted">Kategori</h5>
                    <h2 class="fw-bold mt-2">0</h2>
                    <p class="text-muted mb-0 small">Kelompokkan aset Anda</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card dashboard-card h-100 p-3 border-start border-warning">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-muted">Aktivitas</h5>
                    <h2 class="fw-bold mt-2">Aktif</h2>
                    <p class="text-muted mb-0 small">Sesi login Anda aktif</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
