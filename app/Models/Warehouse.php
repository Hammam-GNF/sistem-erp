<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'location'];

    public function stocks()
    {
        return $this->hasMany(ProductStock::class);
    }

    public function movements()
    {
        return $this->hasMany(StockMovement::class);
    }
}
