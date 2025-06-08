<?php

namespace App\Http\Controllers;

use App\Models\InventoryCategory;
use App\Http\Requests\BudgetCategoryRequest;
use App\Services\InventoryCategoryService;
use App\DataTables\CmsDataTable;

class InventoryCategoryController extends Controller
{
    protected $inventoryCategoryService;

    public function __construct(InventoryCategoryService $inventoryCategoryService)
    {
        $this->inventoryCategoryService = $inventoryCategoryService;
    }

    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Inventory Category';
        $resource = 'inventory_category';
        $columns = ['id', 'name', 'remarks', 'actions'];
        $data = InventoryCategory::getAllInventoryCategories();

        return $dataTable
            ->render('cms.index', compact(
                'page_title',
                'resource',
                'columns',
                'data',
                'dataTable',
            ));
    }

    public function store(BudgetCategoryRequest $request)
    {
        $this->inventoryCategoryService->store($request->validated());

        return redirect()
            ->route('inventory_category.index')
            ->with('success', 'Inventory category created successfully!');
    }

    public function update(BudgetCategoryRequest $request, InventoryCategory $inventoryCategory)
    {
        $this->inventoryCategoryService->update($request->validated(), $inventoryCategory);

        return redirect()
            ->route('inventory_category.index')
            ->with('success', 'Inventory category updated successfully!');
    }

    public function destroy(InventoryCategory $inventoryCategory)
    {
        $this->inventoryCategoryService->destroy($inventoryCategory);

        return redirect()
            ->route('inventory_category.index')
            ->with('success', 'Inventory category delete successfully!');
    }
}
