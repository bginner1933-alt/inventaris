@extends('layouts.dashboard')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.category.index') }}">Kategori</a>
            </li>
            <li class="breadcrumb-item active">
                {{ $category->name ?? 'Kategori Tidak Ditemukan' }}
            </li>
        </ol>
    </nav>

    {{-- Nama Kategori --}}
    <h2 class="mb-4">{{ $category->name ?? '-' }}</h2>

    {{-- Daftar Produk --}}
    <div class="row">
        @forelse($category->products as $product)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/no-image.png') }}"
                     class="card-img-top" alt="{{ $product->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">
                        Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}
                    </p>
                    public function up(): void
                    {
                    Schema::table('users', function (Blueprint $table) {
                    // Tambahkan kolom photo setelah kolom email (opsional penempatannya)
                    $table->string('photo')->nullable()->after('email');
                    });
                    }
                    
                    public function down(): void
                    {
                    Schema::table('users', function (Blueprint $table) {
                    $table->dropColumn('photo');
                    });
                    }
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <p class="text-muted">Belum ada produk di kategori ini.</p>
        </div>
        @endforelse
    </div>

</div>
@endsection
