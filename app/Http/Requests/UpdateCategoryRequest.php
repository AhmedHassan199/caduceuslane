<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends BaseFormRequest
{
    public function authorize()
    {
        return true; // Ensure admin authorization is handled in the controller
    }

    public function rules()
    {
        return [
            'name' => 'required|string|min:2|max:100',
        ];
    }
}
