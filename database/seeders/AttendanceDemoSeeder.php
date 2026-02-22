<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\TeamMember;
use App\Models\Document;
use App\Models\AttendanceRecord;
use App\Models\VerificationHistory;

class AttendanceDemoSeeder extends Seeder
{
    public function run(): void
    {
        
        $members = TeamMember::query()->take(12)->get();

        if ($members->isEmpty()) {
            $this->command?->warn('No TeamMember records found. Run your DatabaseSeeder first.');
            return;
        }

        //Wipe only the demo tables (optional; keeps it clean for repeated seeding)
        AttendanceRecord::query()->delete();
        Document::query()->delete();
        VerificationHistory::query()->delete();

        $projects = [
            'Archylax Residence',
            'Maple Heights',
            'Brickstone Avenue',
            'NorthGate Hub',
            'GreenField Center',
            'EastRiver Link',
            'HarborLine Crossing',
            'LakeView Greens',
        ];

        $fileTypes = [
            ['ext' => 'pdf',  'type' => 'PDF',  'icon' => 'pdf'],
            ['ext' => 'docx', 'type' => 'DOCX', 'icon' => 'docx'],
        ];

        // Create pending attendance submissions (for your attendance table design)
        $perMember = 2;
        $membersToSeed = $members->take(12);
        $seq = 1;

        foreach ($membersToSeed as $m) {
            for ($i = 0; $i < $perMember; $i++) {
                $pick = $fileTypes[($seq - 1) % count($fileTypes)];
                $fileName = "File_" . $seq . "." . $pick['ext'];

                // fake sizes like your UI (0.2 MB, 3.6 MB etc.)
                $sizeMb = number_format(mt_rand(2, 55) / 10, 1); // 0.2 to 5.5
                $size = $sizeMb . " MB";

                // fake path (put any placeholder; won't be real unless you add the file)
                $path = "uploads/reports/" . Str::random(10) . "_" . $fileName;

                $doc = Document::create([
                    'team_member_id' => $m->id,
                    'name' => $fileName,
                    'size' => $size,
                    'type' => $pick['type'],
                    'path' => $path,
                ]);

                $date = Carbon::now()->subDays(mt_rand(1, 45))->toDateString();

                AttendanceRecord::create([
                    'team_member_id' => $m->id,
                    'document_id' => $doc->id,
                    'project' => $projects[($seq - 1) % count($projects)],
                    'date' => $date,
                    'status' => 'pending',
                    'remarks' => null,
                ]);

                $seq++;
            }
        }

        // Create some history rows (for the dashboard table)
        // NOTE: Your controller pulls latest 7.
        $historyCount = 12;
        for ($i = 0; $i < $historyCount; $i++) {
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

        $this->command?->info('✅ Attendance demo data seeded (pending submissions + verification history).');
    }
}
