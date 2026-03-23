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
        $columns = ['id', 'category', 'allocated', 'spent', 'file'];
        $data = Budget::getAllBudgets();
        $budgetCategories = BudgetCategory::getAllBudgetCategories();

        return $dataTable->render('budget', compact(
            'page_title',
            'resource',
            'columns',
            'data',
            'dataTable',
            'budgetCategories'
        ));
    }

    public function byUser(User $user)
{
    $budgets = $user->budgets()->with('category')->get();
    return view('budget.by-user', compact('user', 'budgets'));
}

    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Budget';
        $resource = 'budget';
        $columns = ['id', 'category', 'allocated', 'spent', 'file', 'actions'];
        $data = Budget::with('category')->latest()->get();
        $budgetCategories = BudgetCategory::getAllBudgetCategories();

        return $dataTable->render('cms.index', compact(
            'page_title',
            'resource',
            'columns',
            'data',
            'dataTable',
            'budgetCategories'
        ));
    }

    public function store(BudgetRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('budgets', $filename, 'public');
            $data['file'] = $path;
        }

        Budget::create($data);

        return redirect()->route('budget.index')->with('success', 'You have successfully encoded a budget!');
    }

    public function update(BudgetRequest $request, Budget $budget)
    {
        $data = $request->validated();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('budgets', $filename, 'public');
            $data['file'] = $path;
        }

        $budget->update($data);

        return redirect()->route('budget.index')->with('success', 'You have successfully updated a budget!');
    }

    public function destroy(Budget $budget)
    {
        $budget->delete();

        return redirect()->route('budget.index')->with('success', 'You have successfully deleted a budget!');
    }
}
