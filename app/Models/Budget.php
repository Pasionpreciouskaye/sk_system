<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;
    protected $table = 'budgets';
    protected $fillable = [
        'user_id',
        'allocated',
        'date_allocated',
        'spent',
        'date_spent',
        'budget_id',
    ];

    public static function getAllBudgets()
    {
        return self::all();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(BudgetCategory::class, 'budget_id');
    }
}
