@extends('layouts.app')

@section('content')
    <h1>User Dashboard</h1>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Vendors</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalVendors }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total Products</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalProducts }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Total Invoices Created</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalInvoices }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <h2>Manage Resources</h2>
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="{{ route('vendors.index') }}" class="btn btn-link">View Vendors</a>
                </li>
                <li class="list-group-item">
                    <a href="{{ route('products.index') }}" class="btn btn-link">View Products</a>
                </li>
                <li class="list-group-item">
                    <a href="{{ route('invoices.index') }}" class="btn btn-link">View Invoices</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form method="GET" action="{{ route('dashboard') }}">
                <div class="form-group">
                    <label for="date_filter">Filter by Date</label>
                    <select name="date_filter" id="date_filter" class="form-control">
                        <option value="today">Today</option>
                        <option value="this_week">This Week</option>
                        <option value="this_month">This Month</option>
                        <option value="this_year">This Year</option>
                        <option value="custom">Custom Date Range</option>
                    </select>
                </div>
                <div class="form-group custom-date-range d-none">
                    <label for="start_date">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-control">
                    
                    <label for="end_date">End Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('date_filter').addEventListener('change', function() {
            if (this.value === 'custom') {
                document.querySelector('.custom-date-range').classList.remove('d-none');
            } else {
                document.querySelector('.custom-date-range').classList.add('d-none');
            }
        });
    </script>
@endsection
