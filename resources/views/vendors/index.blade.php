<!-- resources/views/vendors/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Vendors</h1>
    <a href="{{ route('vendors.create') }}" class="btn btn-primary">Add Vendor</a>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Name</th>
                <th>Company</th>
                <th>Address</th>
                <th>GST Number</th>
                <th>Currency</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vendors as $vendor)
                <tr>
                    <td>{{ $vendor->full_name }}</td>
                    <td>{{ $vendor->company_name }}</td>
                    <td>{{ $vendor->company_address }}</td>
                    <td>{{ $vendor->gst_number }}</td>
                    <td>{{ $vendor->currency }}</td>
                    <td>
                        <a href="{{ route('vendors.edit', $vendor) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('vendors.destroy', $vendor) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $vendors->links() }}
@endsection
