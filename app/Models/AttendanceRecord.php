<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_member_id',
        'document_id',
        'project',
        'date',
        'status',
        'remarks',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function teamMember()
    {
        return $this->belongsTo(TeamMember::class);
    }

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}