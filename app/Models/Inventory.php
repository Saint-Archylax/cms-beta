<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'material_id',
        'current_quantity',
        'threshold_quantity',
        'max_threshold',
    ];

    protected $casts = [
        'current_quantity' => 'decimal:2',
        'threshold_quantity' => 'decimal:2',
        'max_threshold' => 'decimal:2',
    ];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
