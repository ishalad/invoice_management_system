@extends('layouts.app')

@section('content')
    <h1>Products</h1>

    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Create Product</a>

    <form method="GET" action="{{ route('products.index') }}" class="mb-4">
        <div class="form-group">
            <label for="search">Search</label>
            <input type="text" name="search" id="search" class="form-control" placeholder="Search products..." value="{{ request('search') }}">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Unit</th>
                <th>Price per Unit</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 100px;">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>{{ $product->unit }}</td>
                    <td>{{ $product->price_per_unit }}</td>
                    <td>
                        {{-- <a href="{{ route('products.show', $product) }}" class="btn btn-info btn-sm">View</a> --}}
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No products found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $products->links() }}
@endsection
