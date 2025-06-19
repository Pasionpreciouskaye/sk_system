<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'title' => 'required|string|max:255',
            'announcement' => 'nullable|string',
            'file_name' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:2048',
        ];

        if ($this->isMethod('POST')) {
            $rules['file_name'] = 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:2048';
        }

        return $rules;
    }
}
