<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'code',
        'location',
        'description',
        'progress',
        'status',
        'start_date',
        'end_date',
        'client',
        'image',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function teamMembers()
    {
        return $this->belongsToMany(TeamMember::class, 'project_team_member')
            ->withTimestamps();
    }
}