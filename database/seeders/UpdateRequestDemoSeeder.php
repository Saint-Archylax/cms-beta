<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TeamMember;
use App\Models\TeamMemberUpdateRequest;

class UpdateRequestDemoSeeder extends Seeder
{
    public function run(): void
    {
        $m = TeamMember::first();
        if (!$m) return;

        // create 1 pending update request for the first member
        TeamMemberUpdateRequest::updateOrCreate(
            ['team_member_id' => $m->id, 'status' => 'pending'],
            ['changes' => [
                'name' => 'Archyl',
                'role' => 'Full Stack',
                'address_city' => 'Davao',
                'email' => 'saint@me.com',
                'phone' => '09123456789',
            ]]
        );
    }
}
