@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Profil Pengguna</h5>
                </div>

                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D6EFD&color=fff"
                            alt="Avatar" class="rounded-circle img-thumbnail" style="width: 100px;">
                        <h4 class="mt-3">{{ Auth::user()->name }}</h4>
                        <span class="badge bg-secondary">Member sejak {{ Auth::user()->created_at->format('M Y')
                            }}</span>
                    </div>

                    <hr>

                    <form action="#" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ Auth::user()->name }}" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}"
                                disabled>
                            <div class="form-text">Email tidak dapat diubah untuk keamanan.</div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password Baru (Kosongkan jika tidak ingin
                                ganti)</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection