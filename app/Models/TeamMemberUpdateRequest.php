<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMemberUpdateRequest extends Model
{
    protected $fillable = [
        'team_member_id',
        'changes',
        'status',
        'remarks',
        'reviewed_at',
    ];

    protected $casts = [
        'changes' => 'array',
        'reviewed_at' => 'datetime',
    ];

    public function teamMember()
    {
        return $this->belongsTo(TeamMember::class);
    }
}
