@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h3 class="mb-4">Kategori: {{ $category->name }}</h3>

    <div class="row">
        @forelse ($category->products as $product)
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <img src="{{ asset('storage/' . $product->image) }}"
                         class="card-img-top"
                         alt="{{ $product->name }}">

                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="text-primary">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>

                        <a href="{{ route('products.show', $product->id) }}"
                           class="btn btn-sm btn-primary">
                            Lihat Produk
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-warning">
                Belum ada produk di kategori ini.
            </div>
        @endforelse
    </div>
</div>
@endsection
