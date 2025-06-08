<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\BudgetCategory;
use App\Http\Requests\BudgetRequest;
use App\DataTables\CmsDataTable;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{
    public function budgetShow(CmsDataTable $dataTable)
    {
        $page_title = 'Budget';
        $resource = 'budget';
        $columns = ['id', 'category', 'allocated', 'spent'];
        $data = Budget::getAllBudgets();
        $budgetCategories = BudgetCategory::getAllBudgetCategories();

        return $dataTable
            ->render('budget', compact(
                'page_title',
                'resource',
                'columns',
                'data',
                'dataTable',
                'budgetCategories',
            ));
    }

    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Budget';
        $resource = 'budget';
        $columns = ['id', 'category', 'allocated', 'spent', 'actions'];
        $data = Budget::getAllBudgets();
        $budgetCategories = BudgetCategory::getAllBudgetCategories();

        return $dataTable
            ->render('cms.index', compact(
                'page_title',
                'resource',
                'columns',
                'data',
                'dataTable',
                'budgetCategories',
            ));
    }

    public function store(BudgetRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        Budget::create($data);

        return redirect()
            ->route('budget.index')
            ->with('success', 'You have successfully encoded a budget!');
    }

    public function update(BudgetRequest $request, Budget $budget)
    {
        $budget->update($request->validated());

        return redirect()
            ->route('budget.index')
            ->with('success', 'You have successfully update a budget!');
    }

    public function destroy(Budget $budget)
    {
        $budget->delete();

        return redirect()
            ->route('budget.index')
            ->with('success', 'You have successfully delete a budget!');
    }
}
