<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'materials',
        'quantity',
        'price_per_unit',
        'total',
        'date',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
