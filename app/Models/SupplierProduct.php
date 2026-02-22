<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierProduct extends Model
{
    protected $fillable = [
        'supplier_id',
        'product_name',
        'unit_of_measure',
        'price',
        'image_path',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
