@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('storage/' . $product->image) }}"
                 class="img-fluid rounded"
                 alt="{{ $product->name }}">
        </div>

        <div class="col-md-6">
            <h3>{{ $product->name }}</h3>

            <p class="text-muted">
                Kategori:
                <a href="{{ route('categories.show', $product->category->id) }}">
                    {{ $product->category->name }}
                </a>
            </p>

            <h4 class="text-primary">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </h4>

            <p>{{ $product->description }}</p>
        </div>
    </div>
</div>
@endsection
