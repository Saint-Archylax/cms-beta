<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\TeamMember;
use App\Models\Document;
use App\Models\PayrollRecord;
use App\Models\AttendanceRecord;
use App\Models\VerificationHistory;
use App\Models\PayrollRequest;
use App\Models\ExpenseRequest;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Team Members
        $teamMembers = [
            [
                'name' => 'Saint Archylax',
                'role' => 'Project Manager',
                'location' => 'Onsite',
                'salary' => '₱75,000',
                'email' => 'archylax@me.com',
                'phone' => '09034867656',
                'gender' => 'Male',
                'date_of_birth' => '2004-05-19',
                'nationality' => 'Filipino',
                'address_line' => 'Matina',
                'address_city' => 'Cabadbaran City',
                'address_state' => 'Agusan del Norte',
                'workload' => 3,
            ],
            [
                'name' => 'Engr. Jomar Alvarado',
                'role' => 'Architect',
                'location' => 'Onsite',
                'salary' => '₱85,000',
                'email' => 'jomar@metalift.com',
                'phone' => '09123456789',
                'gender' => 'Male',
                'date_of_birth' => '1990-01-15',
                'nationality' => 'Filipino',
                'address_line' => 'Downtown',
                'address_city' => 'Davao City',
                'address_state' => 'Davao del Sur',
                'workload' => 4,
            ],
            [
                'name' => 'Engr. Paolo Sarmiento',
                'role' => 'Civil Engineer',
                'location' => 'Remote',
                'salary' => '₱80,000',
                'email' => 'paolo@metalift.com',
                'phone' => '09234567890',
                'gender' => 'Male',
                'date_of_birth' => '1988-03-22',
                'nationality' => 'Filipino',
                'address_line' => 'Poblacion',
                'address_city' => 'Tagum City',
                'address_state' => 'Davao del Norte',
                'workload' => 2,
            ],
            [
                'name' => 'Engr. Janine Cruz',
                'role' => 'Plumbing Specialist',
                'location' => 'Onsite',
                'salary' => '₱60,000',
                'email' => 'janine@metalift.com',
                'phone' => '09345678901',
                'gender' => 'Female',
                'date_of_birth' => '1992-07-10',
                'nationality' => 'Filipino',
                'address_line' => 'Buhangin',
                'address_city' => 'Davao City',
                'address_state' => 'Davao del Sur',
                'workload' => 1,
            ],
            [
                'name' => 'Engr. Rico Fernandez',
                'role' => 'Safety Officer',
                'location' => 'Onsite',
                'salary' => '₱55,000',
                'email' => 'rico@metalift.com',
                'phone' => '09456789012',
                'gender' => 'Male',
                'date_of_birth' => '1985-11-05',
                'nationality' => 'Filipino',
                'address_line' => 'Lanang',
                'address_city' => 'Davao City',
                'address_state' => 'Davao del Sur',
                'workload' => 3,
            ],
            [
                'name' => 'Mang Tonyo Reyes',
                'role' => 'Foreman',
                'location' => 'Onsite',
                'salary' => '₱38,000',
                'email' => 'tonyo@metalift.com',
                'phone' => '09567890123',
                'gender' => 'Male',
                'date_of_birth' => '1975-09-18',
                'nationality' => 'Filipino',
                'address_line' => 'Toril',
                'address_city' => 'Davao City',
                'address_state' => 'Davao del Sur',
                'workload' => 5,
            ],
            [
                'name' => 'Darlene Robertson',
                'role' => 'Foreman',
                'location' => 'Onsite',
                'salary' => '₱38,000',
                'email' => 'darlene@metalift.com',
                'phone' => '09678901234',
                'gender' => 'Female',
                'date_of_birth' => '1980-02-28',
                'nationality' => 'Filipino',
                'address_line' => 'Mintal',
                'address_city' => 'Davao City',
                'address_state' => 'Davao del Sur',
                'workload' => 0,
            ],
            [
                'name' => 'Eleanor Pena',
                'role' => 'Electrician',
                'location' => 'Remote',
                'salary' => '₱24,000',
                'email' => 'eleanor@metalift.com',
                'phone' => '09789012345',
                'gender' => 'Female',
                'date_of_birth' => '1995-04-12',
                'nationality' => 'Filipino',
                'address_line' => 'Agdao',
                'address_city' => 'Davao City',
                'address_state' => 'Davao del Sur',
                'workload' => 2,
            ],
            [
                'name' => 'Matthew Opiano',
                'role' => 'Construction Worker',
                'location' => 'Onsite',
                'salary' => '₱20,000',
                'email' => 'matthew@metalift.com',
                'phone' => '09890123456',
                'gender' => 'Male',
                'date_of_birth' => '1998-12-03',
                'nationality' => 'Filipino',
                'address_line' => 'Sasa',
                'address_city' => 'Davao City',
                'address_state' => 'Davao del Sur',
                'workload' => 4,
            ],
            [
                'name' => 'Levron Matugas',
                'role' => 'Construction Worker',
                'location' => 'Onsite',
                'salary' => '₱20,000',
                'email' => 'levron@metalift.com',
                'phone' => '09901234567',
                'gender' => 'Male',
                'date_of_birth' => '1997-08-20',
                'nationality' => 'Filipino',
                'address_line' => 'Panacan',
                'address_city' => 'Davao City',
                'address_state' => 'Davao del Sur',
                'workload' => 3,
            ],
        ];

        foreach ($teamMembers as $member) {
            TeamMember::create($member);
        }

        // Create Projects
        $projects = [
            [
                'name' => 'GreenField Center',
                'type' => 'Park Project',
                'code' => 'GF-PRK-2025',
                'location' => 'GreenField Subdivision, Cabantian, Davao City',
                'description' => 'Development of a community park and open recreational space, including landscaped walkways, playground areas, shaded seating, lighting, and communal plazas for neighborhood events.',
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
                'description' => 'Construction of a modern two-story residential house with contemporary design elements.',
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
                'description' => 'Major infrastructure project for a steel arch bridge spanning the Davao River.',
                'progress' => 90,
                'status' => 'ongoing',
                'start_date' => '2025-01-10',
                'end_date' => '2025-08-31',
                'client' => 'DPWH Region XI',
                'image' => 'projects/roxas-bridge.jpg',
            ],
        ];

        foreach ($projects as $projectData) {
            Project::create($projectData);
        }

        // Attach team members to projects
        $project1 = Project::find(1);
        $project1->teamMembers()->attach([1, 2, 3, 4]);

        // Create Payroll Requests
        $payrollRequests = [
            [
                'name' => 'Eng. Archyluck Saint',
                'file_name' => 'File_9c.pdf',
                'file_path' => 'files/File_9c.pdf',
                'rate' => '₱60,000',
                'date' => '2024-12-09',
                'status' => 'pending',
            ],
            [
                'name' => 'Engr. Jomar Alvarado',
                'file_name' => 'File_1k.pdf',
                'file_path' => 'files/File_1k.pdf',
                'rate' => '₱70,000',
                'date' => '2024-12-09',
                'status' => 'pending',
            ],
        ];

        foreach ($payrollRequests as $request) {
            PayrollRequest::create($request);
        }

        // Create Expense Requests
        $expenseRequests = [
            [
                'materials' => 'Concrete',
                'quantity' => '10,000 kg',
                'price_per_unit' => '₱100 per 25kg',
                'total' => '₱40,000',
                'date' => '2024-12-09',
                'status' => 'pending',
            ],
            [
                'materials' => 'G1 Gravel',
                'quantity' => '1,000 sack',
                'price_per_unit' => '₱100 per sack',
                'total' => '₱100,000',
                'date' => '2024-12-09',
                'status' => 'pending',
            ],
        ];

        foreach ($expenseRequests as $request) {
            ExpenseRequest::create($request);
        }
    }
}