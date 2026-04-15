<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user')?->id;

        $rules = [
            'first_name'     => 'required|string|max:255',
            'middle_name'    => 'nullable|string|max:255',
            'last_name'      => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email,' . $userId,
            'contact_number' => 'required|string|max:15',
            'date_of_birth'  => 'required|date',
            'gender'         => 'required|in:male,female,Male,Female',
            'address'        => 'required|string|max:255',
            'role'           => 'nullable|in:super_admin,treasurer,secretary,councilor,member',
        ];

        if ($this->isMethod('post')) {
            $rules['password'] = 'required|string|min:8|confirmed';
        } else {
            $rules['password'] = 'nullable|string|min:8|confirmed';
        }

        $rules['profile_picture'] = 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048';

        return $rules;
    }
}
