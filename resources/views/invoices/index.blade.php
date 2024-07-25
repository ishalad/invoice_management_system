@extends('layouts.app')

@section('content')
    <h1>Invoices</h1>

    <a href="{{ route('invoices.create') }}" class="btn btn-primary mb-3">Create Invoice</a>

    <form method="GET" action="{{ route('invoices.index') }}" class="mb-4">
        <div class="form-group">
            <label for="date_filter">Filter by Date</label>
            <select name="date_filter" id="date_filter" class="form-control">
                <option value="">All Time</option>
                <option value="today" {{ request('date_filter') == 'today' ? 'selected' : '' }}>Today</option>
                <option value="this_week" {{ request('date_filter') == 'this_week' ? 'selected' : '' }}>This Week</option>
                <option value="this_month" {{ request('date_filter') == 'this_month' ? 'selected' : '' }}>This Month</option>
                <option value="this_year" {{ request('date_filter') == 'this_year' ? 'selected' : '' }}>This Year</option>
                <option value="custom" {{ request('date_filter') == 'custom' ? 'selected' : '' }}>Custom Date Range</option>
            </select>
        </div>

        <div class="form-group custom-date-range {{ request('date_filter') != 'custom' ? 'd-none' : '' }}">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
            
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
        </div>

        <button type="submit" class="btn btn-primary mt-2">Filter</button>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Invoice Number</th>
                <th>Vendor</th>
                <th>Description</th>
                <th>Total Amount</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->invoice_number }}</td>
                    <td>{{ $invoice->vendor->full_name }}</td>
                    <td>{{ $invoice->description }}</td>
                    <td>{{ $invoice->total_amount }}</td>
                    <td>{{ $invoice->created_at->format('d/m/Y') }}</td>
                    <td>
                        {{-- <a href="{{ route('invoices.show', $invoice) }}" class="btn btn-info btn-sm">View</a> --}}
                        <a href="{{ route('invoices.edit', $invoice) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this invoice?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No invoices found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $invoices->links() }}
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
