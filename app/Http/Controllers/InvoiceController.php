<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::with('vendor', 'products')->paginate(10);
        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vendors = Vendor::all();
        $products = Product::all();
        return view('invoices.create', compact('vendors', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vendor_id' => 'required|exists:vendors,id',
            'invoice_number' => 'required|string|max:255',
            'description' => 'nullable|string',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $invoice = Invoice::create([
            'vendor_id' => $request->vendor_id,
            'invoice_number' => $request->invoice_number,
            'description' => $request->description,
        ]);

        foreach ($request->products as $product) {
            $invoice->products()->attach($product['product_id'], ['quantity' => $product['quantity']]);
        }

        return redirect()->route('invoices.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        $vendors = Vendor::all();
        $products = Product::all();
        return view('invoices.edit', compact('invoice', 'vendors', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  Invoice $invoice)
    {
        $validator = Validator::make($request->all(), [
            'vendor_id' => 'required|exists:vendors,id',
            'invoice_number' => 'required|string|max:255',
            'description' => 'nullable|string',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $invoice->update([
            'vendor_id' => $request->vendor_id,
            'invoice_number' => $request->invoice_number,
            'description' => $request->description,
        ]);

        $invoice->InvoiceProduct()->detach();
        foreach ($request->products as $product) {
            $invoice->invoiceProduct()->attach($product['product_id'], ['quantity' => $product['quantity']]);
        }

        return redirect()->route('invoices.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoices.index');
    }

    public function download(Invoice $invoice)
    {
        // Implement PDF download logic
    }

    public function send(Invoice $invoice)
    {
    \Mail::to($invoice->vendor->email)->send(new \App\Mail\InvoiceMail($invoice));
        return redirect()->route('invoices.index')->with('success', 'Invoice sent successfully!');
    }
}
