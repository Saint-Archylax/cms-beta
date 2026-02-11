<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryTransaction extends Model
{
    protected $fillable = [
        'material_id',
        'type',               // stock_in | stock_out
        'quantity',
        'remaining_stock',
        'project_id',
        'remarks',
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
        'remaining_stock' => 'decimal:2',
    ];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
