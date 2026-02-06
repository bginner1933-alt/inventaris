@extends('layouts.dashboard')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4 shadow-sm">
                <h5 class="card-header fw-bold"><i class="bx bx-user-circle me-2"></i>Pengaturan Profil</h5>

                <div class="card-body">
                    {{-- Alert Success --}}
                    @if(session('success'))
                    <div class="alert alert-primary alert-dismissible" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form action="{{ route('dashboard.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="d-flex align-items-start align-items-sm-center gap-4 mb-4">
                            {{-- Preview Foto Dinamis --}}
                            <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=696cff&color=fff' }}"
                                alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar"
                                style="object-fit: cover;" />

                            <div class="button-wrapper">
                                <label for="photo" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block text-white"><i class="bx bx-upload me-1"></i> Ganti
                                        Foto</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" id="photo" name="photo" class="account-file-input" hidden
                                        accept="image/png, image/jpeg" />
                                </label>
                                <p class="text-muted mb-0 small">Allowed JPG atau PNG. Maksimal 2MB.</p>
                                @error('photo')
                                <span class="text-danger small d-block mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-user"></i></span>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required />
                                </div>
                                @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-12">
                                <label for="email" class="form-label">E-mail</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                    <input class="form-control" type="text" id="email" value="{{ Auth::user()->email }}"
                                        disabled />
                                </div>
                                <div class="form-text">Email terkunci untuk keamanan akun.</div>
                            </div>

                            <div class="mb-3 col-md-12">
                                <label for="password" class="form-label">Ubah Password (Opsional)</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-lock-alt"></i></span>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="············" />
                                </div>
                                @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4 d-flex justify-content-end gap-2">
                            <button type="reset" class="btn btn-outline-secondary"><a href="">Batalkan</a></button>
                            <button type="submit" class="btn btn-primary"><i class="bx bx-check me-1"></i>Simpan
                                Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script Canggih: Live Preview --}}
<script>
    document.getElementById('photo').onchange = function (evt) {
        const [file] = this.files
        if (file) {
            // Mengganti src gambar secara instan saat file dipilih
            document.getElementById('uploadedAvatar').src = URL.createObjectURL(file)
        }
    }
</script>
@endsection