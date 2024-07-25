@extends('layouts.app')

@section('content')
    <h1>Admin Dashboard</h1>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Users</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalUsers }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total Invoices</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalInvoices }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form method="GET" action="{{ route('admin.dashboard') }}">
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

    <div class="row mt-4">
        <div class="col-md-12">
            <h2>Archived Users</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach($archivedUsers as $user)
                        <tr>
                            <td>{{ $user->full_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <form action="{{ route('admin.unarchiveUser', $user) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">Unarchive</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>

            {{-- {{ $archivedUsers->links() }} --}}
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
