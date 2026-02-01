<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_member_id',
        'name',
        'size',
        'type',
        'path',
    ];

    public function teamMember()
    {
        return $this->belongsTo(TeamMember::class);
    }
}