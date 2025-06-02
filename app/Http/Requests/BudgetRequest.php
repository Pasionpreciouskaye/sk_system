<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BudgetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'allocated' => 'required|numeric',
            'date_allocated' => 'required|date',
            'spent' => 'required|numeric',
            'date_spent' => 'required|date',
            'budget_id' => 'required|exists:budget_categories,id'
        ];
    }
}
