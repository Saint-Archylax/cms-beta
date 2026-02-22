<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'supplier_name',
        'contact_info',
        'status',
    ];

    public function materials()
    {
        return $this->hasMany(Material::class);
    }

    public function products()
    {
        return $this->hasMany(SupplierProduct::class);
    }
}
