<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialHistory extends Model
{
    protected $fillable = [
        'material_id',
        'action',
        'from_data',
        'to_data',
    ];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
