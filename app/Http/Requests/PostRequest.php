<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'category' => ['exists:categories,id'],
            'title' => ['required', 'min:10', 'max:255'],
            'content' => ['required', 'min:60'],
        ];
    }

    public function messages(): array
    {
        return [
            'category.exists' => 'The selected category does not exist.',
            'content.min' => 'The content was being too short, please write more than 60 characters.'
        ];
    }
}
