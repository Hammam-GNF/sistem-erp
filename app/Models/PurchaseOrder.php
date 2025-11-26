<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = ['po_number', 'purchase_request_id', 'supplier_id', 'status'];

    public function purchaseRequest()
    {
        return $this->belongsTo(PurchaseRequest::class);
    }
    
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function items()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'ref_id')->where('type', 'purchase');
    }
}
