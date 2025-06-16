<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\InventoryCategory;
use App\Http\Requests\InventoryRequest;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    // Guest-facing inventory view
   public function inventoryShow()
{
    $page_title = 'Inventory';
    $resource = 'inventory-show';
    $columns = ['ID', 'Category', 'Item', 'Quantity', 'Cost', 'Total'];

    $data = Inventory::with('category')->get();

    return view('inventory.show', compact('page_title', 'resource', 'data', 'columns'));
}

    // Admin inventory view
   public function index()
{
    $page_title = 'Inventory';
    $resource = 'inventory';
    $columns = ['id', 'name', 'category', 'quantity', 'cost', 'actions'];

    $data = Inventory::with('category')->get(); // Eager load the category
    $inventoryCategories = InventoryCategory::getAllInventoryCategories();

    return view('inventory.index', compact(
        'page_title',
        'resource',
        'columns',
        'data',
        'inventoryCategories'
    ));
}

    // Store new inventory
    public function store(InventoryRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        Inventory::create($data);

        return redirect()
            ->route('inventory.index')
            ->with('success', 'Inventory successfully added!');
    }

    // Update existing inventory
    public function update(InventoryRequest $request, Inventory $inventory)
    {
        $inventory->update($request->validated());

        return redirect()
            ->route('inventory.index')
            ->with('success', 'Inventory successfully updated!');
    }

    // Delete inventory
    public function destroy(Inventory $inventory)
    {
        $inventory->delete();

        return redirect()
            ->route('inventory.index')
            ->with('success', 'Inventory successfully deleted!');
    }
}
