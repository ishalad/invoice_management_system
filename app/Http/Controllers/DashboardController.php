<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Filtering logic
        $startDate = $request->input('start_date', now()->startOfMonth());
        $endDate = $request->input('end_date', now());

        $totalVendors = Vendor::count();
        $totalProducts = Product::count();
        $totalInvoices = Invoice::whereBetween('created_at', [$startDate, $endDate])->count();

        return view('dashboard.index', compact('totalVendors', 'totalProducts', 'totalInvoices', 'startDate', 'endDate'));
    }

    public function adminIndex(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth());
        $endDate = $request->input('end_date', now());

        $totalUsers = User::count();
        $totalInvoices = Invoice::whereBetween('created_at', [$startDate, $endDate])->count();

        return view('admin.dashboard', compact('totalUsers', 'totalInvoices', 'startDate', 'endDate'));
    }

    public function archiveUser(User $user)
    {
        $user->update(['archived_at' => now()]);
        return redirect()->route('admin.dashboard')->with('success', 'User archived successfully!');
    }
}
