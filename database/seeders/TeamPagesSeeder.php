<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\TeamMember;
use App\Models\Project;
use App\Models\Document;
use App\Models\AttendanceRecord;
use App\Models\VerificationHistory;
use App\Models\PayrollRecord;
use App\Models\TeamMemberUpdateRequest;

class TeamPagesSeeder extends Seeder
{
    public function run(): void
    {
        //ensure members
        $members = TeamMember::query()->take(12)->get();
        if ($members->isEmpty()) {
            $members = TeamMember::factory()->count(12)->create();
        }

        //ensure projects
        $projects = Project::query()->take(5)->get();
        if ($projects->isEmpty()) {
            $projects = collect([
                [
                    'name' => 'GreenField Center',
                    'type' => 'Park Project',
                    'code' => 'GF-PRK-2025',
                    'location' => 'GreenField Subdivision, Cabantian, Davao City',
                    'description' => 'Community park and open recreational space.',
                    'progress' => 60,
                    'status' => 'ongoing',
                    'start_date' => '2025-03-01',
                    'end_date' => '2025-12-15',
                    'client' => 'GreenField Estates Corporation',
                    'image' => 'projects/greenfield-center.jpg',
                ],
                [
                    'name' => 'Maple Residence',
                    'type' => 'House Project',
                    'code' => 'MP-HSE-2025',
                    'location' => 'Maple Heights, Davao City',
                    'description' => 'Modern two-story residential house.',
                    'progress' => 30,
                    'status' => 'ongoing',
                    'start_date' => '2025-04-15',
                    'end_date' => '2025-10-30',
                    'client' => 'Private Homeowner',
                    'image' => 'projects/maple-residence.jpg',
                ],
                [
                    'name' => 'Roxas Bridge',
                    'type' => 'Bridge Project',
                    'code' => 'RX-BRG-2025',
                    'location' => 'Roxas Boulevard, Davao City',
                    'description' => 'Steel arch bridge spanning the Davao River.',
                    'progress' => 90,
                    'status' => 'ongoing',
                    'start_date' => '2025-01-10',
                    'end_date' => '2025-08-31',
                    'client' => 'DPWH Region XI',
                    'image' => 'projects/roxas-bridge.jpg',
                ],
            ])->map(fn ($data) => Project::create($data));
        }

        //attach members to projects
        foreach ($projects as $project) {
            $attachIds = $members->random(min(4, $members->count()))->pluck('id')->all();
            $project->teamMembers()->syncWithoutDetaching($attachIds);
        }

        //documents + attendance (pending)
        foreach ($members as $m) {
            if ($m->documents()->count() === 0) {
                $docCount = 2;
                for ($i = 0; $i < $docCount; $i++) {
                    $ext = $i % 2 === 0 ? 'pdf' : 'docx';
                    $doc = Document::create([
                        'team_member_id' => $m->id,
                        'name' => 'File_' . Str::upper(Str::random(4)) . '.' . $ext,
                        'size' => number_format(mt_rand(2, 55) / 10, 1) . ' MB',
                        'type' => strtoupper($ext),
                        'path' => 'uploads/reports/' . Str::random(10) . '_file.' . $ext,
                    ]);

                    if ($i === 0) {
                        AttendanceRecord::create([
                            'team_member_id' => $m->id,
                            'document_id' => $doc->id,
                            'project' => $projects->random()->name ?? 'Project',
                            'date' => Carbon::now()->subDays(mt_rand(1, 30))->toDateString(),
                            'status' => 'pending',
                            'remarks' => null,
                        ]);
                    }
                }
            }
        }

        //verification history (for dashboard)
        if (VerificationHistory::count() === 0) {
            for ($i = 0; $i < 7; $i++) {
                $m = $members[$i % $members->count()];
                $submitted = Carbon::now()->subDays(mt_rand(10, 120));
                $checked = (clone $submitted)->addDays(mt_rand(1, 5));
                $status = ($i % 4 === 0) ? 'Denied' : 'Verified';

                VerificationHistory::create([
                    'team_member_id' => $m->id,
                    'status' => $status,
                    'date_submitted' => $submitted->toDateString(),
                    'date_checked' => $checked->toDateString(),
                ]);
            }
        }

        //payroll records (for team/payroll)
        foreach ($members as $m) {
            if ($m->payrollRecords()->count() === 0) {
                PayrollRecord::create([
                    'team_member_id' => $m->id,
                    'date_range' => '2025-01-01 - 2025-01-15',
                    'project' => $projects->random()->name ?? 'Project',
                    'days' => mt_rand(5, 12),
                    'salary' => '₱' . number_format(mt_rand(15000, 45000), 0),
                ]);
                PayrollRecord::create([
                    'team_member_id' => $m->id,
                    'date_range' => '2025-01-16 - 2025-01-31',
                    'project' => $projects->random()->name ?? 'Project',
                    'days' => mt_rand(5, 12),
                    'salary' => '₱' . number_format(mt_rand(15000, 45000), 0),
                ]);
            }
        }

        //one pending update request
        $first = $members->first();
        if ($first) {
            TeamMemberUpdateRequest::updateOrCreate(
                ['team_member_id' => $first->id, 'status' => 'pending'],
                ['changes' => [
                    'name' => $first->name,
                    'role' => $first->role,
                    'address_city' => $first->address_city ?? 'Davao',
                    'email' => $first->email ?? 'demo@metalift.com',
                    'phone' => $first->phone ?? '09123456789',
                ]]
            );
        }
    }
}
