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
            'title'   => 'required|string|max:255',
            'content' => 'required|string|max:65535',
            'file_name' => 'nullable|file',
        ];

        if ($this->isMethod('POST')) {
            $rules['file_name'] = 'required|file';
        }

        return $rules;
    }
}
