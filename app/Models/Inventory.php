<?php

// Inventory.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventories';

    protected $fillable = [
        'user_id',
        'name',
        'category_id',
        'quantity',
        'cost',
    ];

    protected $casts = [
        'cost' => 'float',
        'quantity' => 'integer',
    ];

    public static function getAllInventories()
    {
        return self::with('category')->get();
    }

    public function category()
    {
        return $this->belongsTo(InventoryCategory::class, 'category_id');
    }

    // Accessor for total cost (quantity * cost)
    public function getTotalCostAttribute()
    {
        return $this->quantity * $this->cost;
    }
}
