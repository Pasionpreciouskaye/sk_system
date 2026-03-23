<?php

namespace App\Http\Controllers;

use App\Models\BudgetCategory;
use App\Http\Requests\BudgetCategoryRequest;
use App\Services\BudgetCategoryService;
use Illuminate\Http\Request;

class BudgetCategoryController extends Controller
{
    protected $budgetCategoryService;

    public function __construct(BudgetCategoryService $budgetCategoryService)
    {
        $this->budgetCategoryService = $budgetCategoryService;
    }

    // List all categories
    public function index(Request $request)
    {
        $page_title = 'Budget Category';
        $resource = 'budget_category';

        $query = BudgetCategory::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $data = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();

        return view('BudgetCategory.index', compact('page_title', 'resource', 'data'));
    }

    // Show create form
    public function create()
    {
        $page_title = 'Create Budget Category';
        $resource = 'budget_category';
        $record = null;

        return view('BudgetCategory.create', compact('page_title', 'resource', 'record'));
    }

    // Save new record
    public function store(BudgetCategoryRequest $request)
    {
        $this->budgetCategoryService->store($request->validated());

        return redirect()->route('budget_category.index')
            ->with('success', 'Budget category created successfully!');
    }

    // Show details
    public function show(BudgetCategory $budgetCategory)
    {
        $page_title = 'View Budget Category';
        $resource = 'budget_category';

        return view('BudgetCategory.show', compact('page_title', 'resource', 'budgetCategory'));
    }

    // Show edit form
    public function edit(BudgetCategory $budgetCategory)
    {
        $page_title = 'Edit Budget Category';
        $resource = 'budget_category';
        $record = $budgetCategory;

        return view('BudgetCategory.edit', compact('page_title', 'resource', 'record'));
    }

    // Update record
    public function update(BudgetCategoryRequest $request, BudgetCategory $budgetCategory)
    {
        $this->budgetCategoryService->update($request->validated(), $budgetCategory);

        return redirect()->route('budget_category.index')
            ->with('success', 'Budget category updated successfully!');
    }

    // Delete record
    public function destroy(BudgetCategory $budgetCategory)
    {
        $this->budgetCategoryService->destroy($budgetCategory);

        return redirect()->route('budget_category.index')
            ->with('success', 'Budget category deleted successfully!');
    }
}
