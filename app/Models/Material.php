<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materials';

    protected $fillable = [
        'material_name',
        'unit_of_measure',
        'supplier_id',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
