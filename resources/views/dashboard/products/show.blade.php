@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <!-- Gambar Produk -->
        <div class="col-md-6">
            <img src="{{ asset('storage/' . $product->image) }}"
                 class="img-fluid rounded"
                 alt="{{ $product->name }}">
        </div>

        <!-- Detail Produk -->
        <div class="col-md-6">
            <h3>{{ $product->name }}</h3>

            <p class="text-muted">
                Kategori:
                @if($product->category)
                    <a href="{{ route('dashboard.category.show', $product->category->id) }}">
                        {{ $product->category->name }}
                    </a>
                @else
                    -
                @endif
            </p>

            <h4 class="text-primary">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </h4>

            <p>{{ $product->description }}</p>
        </div>
    </div>
</div>
@endsection
