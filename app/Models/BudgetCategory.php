<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetCategory extends Model
{
    use HasFactory;
    protected $table = 'budget_categories';
    protected $fillable = [
        'name',
        'remarks'
    ];

    public static function getAllBudgetCategories()
    {
        return self::all();
    }
}
