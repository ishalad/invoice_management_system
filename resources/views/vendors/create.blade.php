@extends('layouts.app')

@section('content')
    <h1>Create Vendor</h1>
    @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
    <form action="{{ route('vendors.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" name="full_name" id="full_name" class="form-control" value="{{ old('full_name') }}" required>
            @error('full_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="company_name">Company Name</label>
            <input type="text" name="company_name" id="company_name" class="form-control" value="{{ old('company_name') }}" required>
            @error('company_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="company_address">Company Address</label>
            <input type="text" name="company_address" id="company_address" class="form-control" value="{{ old('company_address') }}" required>
            @error('company_address')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="gst_number">GST Number</label>
            <input type="text" name="gst_number" id="gst_number" class="form-control" value="{{ old('gst_number') }}" required>
            @error('gst_number')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="currency">Currency</label>
            <input type="text" name="currency" id="currency" class="form-control" value="{{ old('currency') }}" required>
            @error('currency')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
