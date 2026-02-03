@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h1 class="mb-4">Category</h1>

    <a href="{{ route('dashboard.category.create') }}" class="btn btn-primary mb-3">
        + Tambah Category
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Category</th>
                <th width="20%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories ?? [] as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a href="{{ route('dashboard.category.edit', $category->id) }}" class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        <a href="{{ route('dashboard.category.show', $category->id) }}" class="btn btn-sm btn-primary">
                            Show
                        </a>

                        <form action="{{ route('dashboard.category.destroy', $category->id) }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin hapus?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">
                        Data category kosong
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
