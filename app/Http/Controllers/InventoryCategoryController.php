<?php

namespace App\Http\Controllers;

use App\Models\InventoryCategory;
use App\Http\Requests\BudgetCategoryRequest;
use App\Services\InventoryCategoryService;
use Illuminate\Http\Request;

class InventoryCategoryController extends Controller
{
    protected $inventoryCategoryService;

    public function __construct(InventoryCategoryService $inventoryCategoryService)
    {
        $this->inventoryCategoryService = $inventoryCategoryService;
    }

    public function index(Request $request)
    {
        $page_title = 'Inventory Category';
        $resource = 'inventory_category';

        $query = InventoryCategory::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $data = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();

        return view('InventoryCategory.index', compact('page_title', 'resource', 'data'));
    }

    public function create()
    {
        $page_title = 'Create Inventory Category';
        $resource = 'inventory_category';
        $record = null;
        return view('InventoryCategory.create', compact('page_title', 'resource', 'record'));
    }

    public function store(BudgetCategoryRequest $request)
    {
        $this->inventoryCategoryService->store($request->validated());

        return redirect()->route('inventory_category.index')
            ->with('success', 'Inventory category created successfully!');
    }

    public function show(InventoryCategory $inventoryCategory)
    {
        $page_title = 'View Inventory Category';
        $resource = 'inventory_category';
        return view('InventoryCategory.show', compact('page_title', 'resource', 'inventoryCategory'));
    }

    public function edit(InventoryCategory $inventoryCategory)
    {
        $page_title = 'Edit Inventory Category';
        $resource = 'inventory_category';
        $record = $inventoryCategory;
        return view('InventoryCategory.edit', compact('page_title', 'resource', 'record'));
    }

    public function update(BudgetCategoryRequest $request, InventoryCategory $inventoryCategory)
    {
        $this->inventoryCategoryService->update($request->validated(), $inventoryCategory);

        return redirect()->route('inventory_category.index')
            ->with('success', 'Inventory category updated successfully!');
    }

    public function destroy(InventoryCategory $inventoryCategory)
    {
        $this->inventoryCategoryService->destroy($inventoryCategory);

        return redirect()->route('inventory_category.index')
            ->with('success', 'Inventory category deleted successfully!');
    }
}
