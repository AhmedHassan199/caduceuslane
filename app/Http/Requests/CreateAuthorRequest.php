<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAuthorRequest extends BaseFormRequest
{
    public function authorize()
    {
        // Only allow admins to create authors
        return auth()->user()->role === 'admin';
    }

    public function rules()
    {
        $userId = $this->route('id');

    return [
        'name' => 'required|string|min:2|max:100',
        'email' => 'required|email|unique:users,email,' . $userId,
        'password' => 'required|string|min:6|max:50|regex:/[a-z]/|regex:/[A-Z]/|regex:/[\W_]/',
    ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name is required.',
            'name.min' => 'The name must be at least 2 characters.',
            'name.max' => 'The name cannot be longer than 100 characters.',
            'email.required' => 'The email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email is already taken.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password should be at least 6 characters.',
            'password.max' => 'Password cannot be more than 50 characters.',
            'password.regex' => 'Password must contain at least one lowercase letter, one uppercase letter, and one special character.',
        ];
    }
}
