<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|string|min:2|max:100',
            'description' => 'required|string|min:5|max:500',
            'published_at' => 'required|date',
            'bio' => 'required|string|min:5|max:500',
            'cover' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048',
            'category_id' => 'required|exists:categories,id',

        ];
    }
}
