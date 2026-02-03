@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Category</h1>

    <form action="{{ route('dashboard.category.update', $category->id) }}" method="POST">
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

        <button type="submit" class="btn btn-primary">
            Update
        </button>

        <a href="{{ route('dashboard.category.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </form>
</div>
@endsection
