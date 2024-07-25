@extends('layouts.app')

@section('content')
    <h1>Edit Product</h1>
    @if($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
@endif
    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}" required>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">Product Image</label>
            <input type="file" name="image" id="image" class="form-control">
            @error('image')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="unit">Product Unit</label>
            <input type="text" name="unit" id="unit" class="form-control" value="{{ old('unit', $product->unit) }}" required>
            @error('unit')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="price_per_unit">Product Price per Unit</label>
            <input type="number" name="price_per_unit" id="price_per_unit" class="form-control" value="{{ old('price_per_unit', $product->price_per_unit) }}" required>
            @error('price_per_unit')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
