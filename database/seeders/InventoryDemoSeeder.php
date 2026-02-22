<?php

namespace Database\Seeders;

use App\Models\Inventory;
use App\Models\InventoryTransaction;
use App\Models\Material;
use App\Models\Project;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class InventoryDemoSeeder extends Seeder
{
    public function run(): void
    {
        $suppliersData = [
            ['supplier_name' => 'BuildPro Supply', 'contact_info' => 'buildpro@example.com', 'status' => 'active'],
            ['supplier_name' => 'StoneMax Trading', 'contact_info' => 'stonemax@example.com', 'status' => 'active'],
            ['supplier_name' => 'IronGate Materials', 'contact_info' => 'irongate@example.com', 'status' => 'active'],
            ['supplier_name' => 'Cemexon Depot', 'contact_info' => 'cemexon@example.com', 'status' => 'active'],
            ['supplier_name' => 'HardRock Supply', 'contact_info' => 'hardrock@example.com', 'status' => 'active'],
        ];

        $suppliers = collect($suppliersData)->mapWithKeys(function ($data) {
            $supplier = Supplier::firstOrCreate(
                ['supplier_name' => $data['supplier_name']],
                $data
            );
            return [$supplier->supplier_name => $supplier];
        });

        $projectSeeds = [
            [
                'name' => 'DPW Project - Bukidnon',
                'type' => 'Road Project',
                'code' => 'DPW-BKD-2026',
                'location' => 'Bukidnon',
                'description' => 'Road widening and improvement.',
                'progress' => 65,
                'status' => 'ongoing',
                'start_date' => '2025-11-01',
                'end_date' => '2026-08-30',
                'client' => 'DPW',
            ],
            [
                'name' => 'Road Widening - Manila',
                'type' => 'Road Project',
                'code' => 'RWM-2026',
                'location' => 'Manila',
                'description' => 'Main road widening and safety improvements.',
                'progress' => 40,
                'status' => 'ongoing',
                'start_date' => '2025-10-15',
                'end_date' => '2026-09-15',
                'client' => 'Metro Admin',
            ],
            [
                'name' => 'Road Widening - Davao',
                'type' => 'Road Project',
                'code' => 'RWD-2026',
                'location' => 'Davao City',
                'description' => 'Road widening and drainage improvements.',
                'progress' => 55,
                'status' => 'ongoing',
                'start_date' => '2025-09-10',
                'end_date' => '2026-07-20',
                'client' => 'City Gov',
            ],
        ];

        foreach ($projectSeeds as $seed) {
            Project::firstOrCreate(
                ['code' => $seed['code']],
                $seed
            );
        }

        $projects = Project::orderBy('id')->take(3)->get();

        $materialsData = [
            ['name' => 'Concrete', 'unit' => 'sacks', 'price' => 2000, 'supplier' => 'BuildPro Supply', 'current' => 10, 'threshold' => 10],
            ['name' => 'Plywood', 'unit' => 'pcs', 'price' => 620, 'supplier' => 'StoneMax Trading', 'current' => 2000, 'threshold' => 100],
            ['name' => 'Steel', 'unit' => 'pcs', 'price' => 150, 'supplier' => 'IronGate Materials', 'current' => 1000, 'threshold' => 100],
            ['name' => 'Nails', 'unit' => 'kg', 'price' => 50, 'supplier' => 'Cemexon Depot', 'current' => 2, 'threshold' => 2],
            ['name' => 'PVC Pipes', 'unit' => 'pcs', 'price' => 90, 'supplier' => 'HardRock Supply', 'current' => 300, 'threshold' => 100],
        ];

        $materials = collect();
        foreach ($materialsData as $data) {
            $supplier = $suppliers[$data['supplier']] ?? null;

            $material = Material::updateOrCreate(
                ['material_name' => $data['name']],
                [
                    'unit_of_measure' => $data['unit'],
                    'supplier_id' => $supplier?->id,
                    'unit_price' => $data['price'],
                    'is_active' => 1,
                ]
            );

            Inventory::updateOrCreate(
                ['material_id' => $material->id],
                [
                    'current_quantity' => $data['current'],
                    'threshold_quantity' => $data['threshold'],
                ]
            );

            $materials->put($data['name'], $material);
        }

        $dates = [
            Carbon::create(2024, 12, 9, 10, 0, 0),
            Carbon::create(2024, 12, 9, 11, 0, 0),
            Carbon::create(2024, 12, 9, 12, 0, 0),
            Carbon::create(2024, 12, 9, 13, 0, 0),
            Carbon::create(2024, 12, 9, 14, 0, 0),
        ];

        $historySeeds = [
            ['material' => 'Concrete', 'type' => 'stock_out', 'qty' => 1500, 'remaining' => 500, 'project' => 0],
            ['material' => 'Plywood', 'type' => 'stock_in', 'qty' => 1000, 'remaining' => 200, 'project' => null],
            ['material' => 'Steel', 'type' => 'stock_out', 'qty' => 1500, 'remaining' => 1000, 'project' => 1],
            ['material' => 'Nails', 'type' => 'stock_out', 'qty' => 1000, 'remaining' => 2, 'project' => 2],
            ['material' => 'PVC Pipes', 'type' => 'stock_in', 'qty' => 1500, 'remaining' => 300, 'project' => null],
        ];

        foreach ($historySeeds as $i => $seed) {
            $material = $materials->get($seed['material']);
            if (!$material) {
                continue;
            }

            $projectId = null;
            if ($seed['project'] !== null && isset($projects[$seed['project']])) {
                $projectId = $projects[$seed['project']]->id;
            }

            InventoryTransaction::create([
                'material_id' => $material->id,
                'type' => $seed['type'],
                'quantity' => $seed['qty'],
                'remaining_stock' => $seed['remaining'],
                'project_id' => $projectId,
                'remarks' => 'demo data',
                'created_at' => $dates[$i] ?? now(),
                'updated_at' => $dates[$i] ?? now(),
            ]);
        }
    }
}
