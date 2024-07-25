@extends('layouts.app')

@section('content')
    <h1>Edit Invoice</h1>
    @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
    <form action="{{ route('invoices.update', $invoice) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="vendor_id">Vendor</label>
            <select name="vendor_id" id="vendor_id" class="form-control" required>
                @foreach($vendors as $vendor)
                    <option value="{{ $vendor->id }}" {{ $invoice->vendor_id == $vendor->id ? 'selected' : '' }}>{{ $vendor->full_name }}</option>
                @endforeach
            </select>
            @error('vendor_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="invoice_number">Invoice Number</label>
            <input type="text" name="invoice_number" id="invoice_number" class="form-control" value="{{ old('invoice_number', $invoice->invoice_number) }}" required>
            @error('invoice_number')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $invoice->description) }}</textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="products">Products</label>
            <div id="products">
                @foreach($products as $product)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="products[{{ $product->id }}][product_id]" value="{{ $product->id }}" {{ in_array($product->id, $invoice->products->pluck('id')->toArray()) ? 'checked' : '' }}>
                        <label class="form-check-label">{{ $product->name }}</label>
                        <input type="number" name="products[{{ $product->id }}][quantity]" class="form-control" placeholder="Quantity" value="{{ old('products.'.$product->id.'.quantity', $invoice->products->find($product->id)->pivot->quantity ?? '') }}">
                    </div>
                @endforeach
            </div>
            @error('products')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
