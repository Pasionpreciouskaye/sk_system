<?php

namespace App\Services;

use App\Models\InventoryCategory;

class InventoryCategoryService
{
    public function store(array $data): InventoryCategory
    {
        return InventoryCategory::create($data);
    }

    public function update(array $data, $inventoryCategory): void
    {
        $inventoryCategory->update($data);
    }

    public function destroy($inventoryCategory): void
    {
        $inventoryCategory->delete();
    }
}
