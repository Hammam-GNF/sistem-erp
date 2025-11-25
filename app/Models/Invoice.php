<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_number', 'type', 'ref_id', 'total', 'status'];

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class, 'ref_id');
    }

    public function salesOrder()
    {
        return $this->belongsTo(SalesOrder::class, 'ref_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
