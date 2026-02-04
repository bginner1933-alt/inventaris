@extends('layouts.dashboard')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Sistem /</span> Pengaturan Akun</h4>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>@foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
    </div>
    @endif

    <div class="card">
        <form action="{{ route('dashboard.pengaturan.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="mb-3 col-md-12 text-center">
                        <img src="{{ auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : asset('assets/img/avatars/1.png') }}"
                            class="rounded mb-3" height="120" width="120" style="object-fit: cover;">
                        <input type="file" name="photo" class="form-control w-50 mx-auto">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}">
                    </div>
                    <hr>
                    <h6 class="text-primary">Ganti Password (Opsional)</h6>
                    <div class="mb-3 col-md-4">
                        <label class="form-label">Password Saat Ini</label>
                        <input type="password" name="current_password" class="form-control">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="new_password" class="form-control">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" name="new_password_confirmation" class="form-control">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection