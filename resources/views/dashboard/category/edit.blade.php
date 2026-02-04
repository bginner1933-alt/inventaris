@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Category</h1>

    <form action="{{ route('dashboard.category.update', $category->id) }}" 
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Category</label>
            <input type="text"
                   name="name"
                   class="form-control"
                   value="{{ $category->name }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Foto Category</label>
            <input type="file" name="image" class="form-control">
            
            @if ($category->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $category->image) }}" 
                         alt="{{ $category->name }}" 
                         style="width: 120px; height: 120px; object-fit: cover; border-radius: 5px;">
                    <p class="text-muted mt-1">Foto saat ini</p>
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">
            Update
        </button>

        <a href="{{ route('dashboard.category.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </form>
</div>
@endsection
