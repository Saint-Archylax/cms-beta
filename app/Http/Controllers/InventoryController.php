<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Project;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Material::query()->where('is_active', 1);

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('material_name', 'like', "%{$s}%")
                  ->orWhere('unit_of_measure', 'like', "%{$s}%");
            });
        }

        // ✅ FIX: order by material_name, not name
        $materials = $query->orderBy('material_name')->get();

        // for UI cards (optional)
        $totalMaterials = Material::where('is_active', 1)->count();

        return view('inventory.index', compact('materials', 'totalMaterials'));
    }

    public function stockInOut(Request $request)
{
    $query = Material::query()->where('is_active', 1);

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where('material_name', 'like', "%{$search}%");
    }

    $materials = $query->orderBy('material_name')->get();

    //project dropdown for stock-out
    $projects = Project::orderBy('name')->get();

    $totalMaterials = Material::where('is_active', 1)->count();

    //dummy data ra ni bai
    $topMaterials = collect([]);

    return view('inventory.stock-inout', compact('materials', 'projects', 'totalMaterials', 'topMaterials'));
}

    public function threshold(Request $request)
    {
        $query = Material::query()->where('is_active', 1);

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('material_name', 'like', "%{$s}%")
                  ->orWhere('unit_of_measure', 'like', "%{$s}%");
            });
        }

        $materials = $query->orderBy('material_name')->get();

        return view('inventory.threshold', compact('materials'));
    }

    public function history(Request $request)
    {
        // This depends on your stock history table (not in your DB yet),
        // so keep it as empty list for now to avoid errors.
        $transactions = collect([]);

        return view('inventory.history', compact('transactions'));
    }

    // These 3 methods depend on stock tables/columns, so keep them for later
    public function addStock(Request $request) { abort(501, 'Stock-in not connected yet'); }
    public function useStock(Request $request) { abort(501, 'Stock-out not connected yet'); }
    public function updateThreshold(Request $request) { abort(501, 'Threshold not connected yet'); }
}
