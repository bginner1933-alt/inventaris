@extends('layouts.dashboard')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold py-3 mb-0">
            <span class="text-muted fw-light">Produk /</span> Edit Produk
        </h4>
        <a href="{{ route('dashboard.product.index') }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back me-1"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-4 border-top border-warning">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Perbarui Data Produk</h5>
                    <small class="text-muted float-end text-warning fw-bold">ID: #{{ $product->id }}</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.product.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label" for="name">Nama Produk</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-box"></i></span>
                                <input type="text" name="name" id="name" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    value="{{ old('name', $product->name) }}" required />
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
                                    value="{{ old('price', $product->price) }}" required />
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
                                        <option value="{{ $category->id }}" 
                                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
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
                            <button type="submit" class="btn btn-warning d-flex align-items-center">
                                <i class="bx bx-refresh me-1"></i> Perbarui Produk
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection