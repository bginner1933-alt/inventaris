@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Category</h1>

    <form action="{{ route('dashboard.category.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Category</label>
            <input type="text"
                   name="name"
                   class="form-control"
                   placeholder="Masukkan nama category"
                   required>
        </div>

        <button type="submit" class="btn btn-primary">
            Simpan
        </button>

        <a href="{{ route('dashboard.category.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </form>
</div>
@endsection
