<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id', 
        'product_id', 
        'quantity'
    ];

    public function invoices()
{
    return $this->belongsToMany(Invoice::class, 'invoice_product')
                ->withPivot('quantity');
}
}
