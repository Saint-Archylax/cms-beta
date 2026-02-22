<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TeamMember;

class TeamDemoSeeder extends Seeder
{
    public function run(): void
    {
        //create 50 team members for testing
        TeamMember::factory()->count(50)->create();
    }
}
