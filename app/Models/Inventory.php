<?php

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

    public static function getAllInventories()
    {
        return self::all();
    }

    public function category()
    {
        return $this->belongsTo(InventoryCategory::class, 'category_id');
    }
}
