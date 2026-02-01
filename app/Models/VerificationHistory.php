<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_member_id',
        'status',
        'date_submitted',
        'date_checked',
    ];

    protected $casts = [
        'date_submitted' => 'date',
        'date_checked' => 'date',
    ];

    public function teamMember()
    {
        return $this->belongsTo(TeamMember::class);
    }
}