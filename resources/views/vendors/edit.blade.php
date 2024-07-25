@extends('layouts.app')

@section('content')
    <h1>Edit Vendor</h1>

    <form action="{{ route('vendors.update', $vendor) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" name="full_name" id="full_name" class="form-control" value="{{ old('full_name', $vendor->full_name) }}" required>
            @error('full_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="company_name">Company Name</label>
            <input type="text" name="company_name" id="company_name" class="form-control" value="{{ old('company_name', $vendor->company_name) }}" required>
            @error('company_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="company_address">Company Address</label>
            <input type="text" name="company_address" id="company_address" class="form-control" value="{{ old('company_address', $vendor->company_address) }}" required>
            @error('company_address')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="gst_number">GST Number</label>
            <input type="text" name="gst_number" id="gst_number" class="form-control" value="{{ old('gst_number', $vendor->gst_number) }}" required>
            @error('gst_number')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="currency">Currency</label>
            <input type="text" name="currency" id="currency" class="form-control" value="{{ old('currency', $vendor->currency) }}" required>
            @error('currency')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
