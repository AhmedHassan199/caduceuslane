<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'title' => 'nullable|string|min:2|max:100',
            'description' => 'nullable|string|min:5|max:500',
            'published_at' => 'nullable|date',
            'bio' => 'nullable|string|min:5|max:500',
            'cover' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'category_id' => 'required|exists:categories,id',
        ];
    }
}
