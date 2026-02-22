<?php

namespace Database\Seeders;

use App\Models\Supplier;
use App\Models\SupplierProduct;
use Illuminate\Database\Seeder;

class SupplierProductsSeeder extends Seeder
{
    public function run(): void
    {
        $catalog = [
            ['product_name' => 'Cement', 'unit_of_measure' => 'sack', 'price' => 100],
            ['product_name' => 'Concrete Sealant', 'unit_of_measure' => '10L', 'price' => 1000],
            ['product_name' => 'Hollow Blocks', 'unit_of_measure' => 'block', 'price' => 20],
            ['product_name' => 'G1 Gravel', 'unit_of_measure' => 'sack', 'price' => 100],
            ['product_name' => 'Crushed Stone', 'unit_of_measure' => 'sack', 'price' => 90],
            ['product_name' => 'PVC Pipes', 'unit_of_measure' => 'pcs', 'price' => 90],
            ['product_name' => 'Electrical Wires', 'unit_of_measure' => 'meter', 'price' => 45],
            ['product_name' => 'Nails', 'unit_of_measure' => 'kg', 'price' => 50],
        ];

        $suppliers = Supplier::all();
        foreach ($suppliers as $supplier) {
            foreach ($catalog as $item) {
                SupplierProduct::firstOrCreate(
                    [
                        'supplier_id' => $supplier->id,
                        'product_name' => $item['product_name'],
                    ],
                    [
                        'unit_of_measure' => $item['unit_of_measure'],
                        'price' => $item['price'],
                        'image_path' => null,
                    ]
                );
            }
        }
    }
}
