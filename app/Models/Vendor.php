<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name', 
        'company_name', 
        'company_address', 
        'gst_number', 
        'currency'
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
