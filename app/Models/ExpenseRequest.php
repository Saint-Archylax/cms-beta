<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'material_id',
        'materials',
        'quantity',
        'quantity_value',
        'price_per_unit',
        'total',
        'date',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
        'quantity_value' => 'decimal:2',
    ];
}
