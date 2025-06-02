<?php

namespace App\Http\Controllers;

use App\Models\BudgetCategory;
use App\Http\Requests\BudgetCategoryRequest;
use App\Services\BudgetCategoryService;
use App\DataTables\CmsDataTable;

class BudgetCategoryController extends Controller
{
    protected $budgetCategoryService;

    public function __construct(BudgetCategoryService $budgetCategoryService)
    {
        $this->budgetCategoryService = $budgetCategoryService;
    }

    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Budget Category';
        $resource = 'budget_category';
        $columns = ['id', 'name', 'remarks', 'actions'];
        $data = BudgetCategory::getAllBudgetCategories();

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
        $this->budgetCategoryService->store($request->validated());

        return redirect()
            ->route('budget_category.index')
            ->with('success', 'Budget category created successfully!');
    }
    
    public function update(BudgetCategoryRequest $request, BudgetCategory $budgetCategory)
    {
        $this->budgetCategoryService->update($request->validated(), $budgetCategory);

        return redirect()
            ->route('budget_category.index')
            ->with('success', 'Budget category updated successfully!');
    }
    
    public function destroy(BudgetCategory $budgetCategory)
    {
        $this->budgetCategoryService->destroy($budgetCategory);

        return redirect()
            ->route('budget_category.index')
            ->with('success', 'Budget category deleted successfully!');
    }
}
