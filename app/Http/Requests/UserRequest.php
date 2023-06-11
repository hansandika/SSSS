<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'date_of_birth' => ['date', 'before:today'],
            'name' => ['max:255'],
            'avatar' => ['image', 'max:2048', 'mimes:jpeg,png,jpg,gif,svg'],
            'gender' => ['string', 'in:male,female,non-binary'],
            'biography' => ['max:500', 'min:10'],
        ];
    }
}
