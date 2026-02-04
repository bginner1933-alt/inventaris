@extends('layouts.dashboard')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold py-3 mb-0">
            <span class="text-muted fw-light">Produk /</span> Tambah Baru
        </h4>
        <a href="{{ route('dashboard.product.index') }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back me-1"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Detail Produk</h5>
                    <small class="text-muted float-end">Pastikan data yang diinput benar</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.product.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label" for="name">Nama Produk</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-box"></i></span>
                                <input type="text" name="name" id="name" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    placeholder="Masukkan nama produk..." 
                                    value="{{ old('name') }}" required />
                            </div>
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="price">Harga</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="price" id="price" 
                                    class="form-control @error('price') is-invalid @enderror" 
                                    placeholder="0" 
                                    value="{{ old('price') }}" required />
                            </div>
                            @error('price')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="category_id">Kategori</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-category"></i></span>
                                <select name="category_id" id="category_id" 
                                    class="form-select @error('category_id') is-invalid @enderror" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category_id')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary d-flex align-items-center">
                                <i class="bx bx-save me-1"></i> Simpan Produk
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection