<?php

namespace App\Services;

use App\Models\BudgetCategory;

class BudgetCategoryService
{
    public function store(array $data): BudgetCategory
    {
        return BudgetCategory::create($data);
    }

    public function update(array $data, $budgetCategory): void
    {
        $budgetCategory->update($data);
    }

    public function destroy($budgetCategory): void
    {
        $budgetCategory->delete();
    }
}