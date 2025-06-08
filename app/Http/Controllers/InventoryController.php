<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\InventoryCategory;
use App\Http\Requests\InventoryRequest;
use App\DataTables\CmsDataTable;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function inventoryShow(CmsDataTable $dataTable)
    {
        $page_title = 'Inventory';
        $resource = 'inventory';
        $columns = ['id', 'category', 'name', 'quantity', 'cost'];
        $data = Inventory::getAllInventories();
        $inventoryCategories = InventoryCategory::getAllInventoryCategories();

        return $dataTable
            ->render('budget', compact(
                'page_title',
                'resource',
                'columns',
                'data',
                'dataTable',
                'inventoryCategories',
            ));
    }

    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Inventory';
        $resource = 'inventory';
        $columns = ['id', 'category', 'name', 'quantity', 'cost', 'actions'];
        $data = Inventory::getAllInventories();
        $inventoryCategories = InventoryCategory::getAllInventoryCategories();

        return $dataTable
            ->render('cms.index', compact(
                'page_title',
                'resource',
                'columns',
                'data',
                'dataTable',
                'inventoryCategories',
            ));
    }

    public function store(InventoryRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        Inventory::create($data);

        return redirect()
            ->route('inventory.index')
            ->with('success', 'You have successfully encoded a inventory!');
    }

    public function update(InventoryRequest $request, Inventory $inventory)
    {
        $inventory->update($request->validated());

        return redirect()
            ->route('inventory.index')
            ->with('success', 'You have successfully update a inventory!');
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();

        return redirect()
            ->route('inventory.index')
            ->with('success', 'You have successfully delete a inventory!');
    }
}
