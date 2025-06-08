<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryCategory extends Model
{
    use HasFactory;
    protected $table = 'inventory_categories';
    protected $fillable = [
        'name',
        'remarks'
    ];

    public static function getAllInventoryCategories()
    {
        return self::all();
    }
}
