<?php

// InventoryRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:inventory_categories,id',
            'quantity' => 'required|integer|min:0',
            'cost' => 'required|numeric|min:0',
        ];
    }
}
