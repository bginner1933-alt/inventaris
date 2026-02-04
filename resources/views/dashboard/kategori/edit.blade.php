@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Kategori: {{ $category->nama }}</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('dashboard.category.update', $category->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama">Nama Kategori</label>
                    <input type="text" name="nama" value="{{ $category->nama }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3">{{ $category->deskripsi }}</textarea>
                </div>

                <div class="form-group">
                    <label>Foto Saat Ini</label><br>
                    @if($category->image)
                    <img src="{{ asset($category->image) }}" width="100" class="mb-2">
                    @endif
                    <input type="file" name="image" class="form-control-file">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
                </div>

                <button type="submit" class="btn btn-primary">Update Kategori</button>
                <a href="{{ route('dashboard.category.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection