@extends('layouts.dashboard')
@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4">Edit Kategori</h1>
    <div class="card shadow col-lg-6">
        <div class="card-body">
            <form action="{{ route('dashboard.kategori.update', $kategori->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="form-group mb-3">
                    <label>Nama Kategori</label>
                    <input type="text" name="nama" class="form-control" value="{{ $kategori->nama }}" required>
                </div>
                <div class="form-group mb-3">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control">{{ $kategori->deskripsi }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection