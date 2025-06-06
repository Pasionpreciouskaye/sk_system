<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Project;
use App\Models\Event;
use App\Models\Budget;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProjects = Project::count();
        $totalEvents   = Event::count();

        $monthlyData = Budget::select(
                DB::raw("DATE_FORMAT(date_spent, '%Y-%m') AS month_key"),
                DB::raw("SUM(spent) AS total_spent")
            )
            ->whereNotNull('date_spent')
            ->groupBy('month_key')
            ->orderBy('month_key')
            ->get();

        $budgetMonths    = $monthlyData->pluck('month_key')->toArray();
        $budgetTotals    = $monthlyData->pluck('total_spent')
                                ->map(fn($val) => (float) $val)
                                ->toArray();

        $budgetLabelsPretty = array_map(
            fn($ym) => Carbon::createFromFormat('Y-m', $ym)->format('M Y'),
            $budgetMonths
        );
        $inventoryData = Inventory::select(
                'inventory_categories.name AS category_name',
                DB::raw('SUM(inventories.quantity) AS total_quantity')
            )
            ->join('inventory_categories', 'inventories.category_id', '=', 'inventory_categories.id')
            ->groupBy('inventory_categories.name')
            ->orderBy('inventory_categories.name')
            ->get();

        $inventoryLabels     = $inventoryData->pluck('category_name')->toArray();
        $inventoryQuantities = $inventoryData->pluck('total_quantity')
                                    ->map(fn($q) => (int) $q)
                                    ->toArray();

        return view('dashboard', [
            'totalProjects'       => $totalProjects,
            'totalEvents'         => $totalEvents,
            'budgetLabelsPretty'  => $budgetLabelsPretty,
            'budgetTotals'        => $budgetTotals,
            'inventoryLabels'     => $inventoryLabels,
            'inventoryQuantities' => $inventoryQuantities,
        ]);
    }
}
