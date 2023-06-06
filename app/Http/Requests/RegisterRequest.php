<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email:rfc,dns', 'unique:users,email'],
            'date_of_birth' => ['required', 'before:today'],
            'password' => ['required', 'min:7', 'max:30', 'alpha_num'],
            'confirm-password' => ['required', 'same:password'],
            'gender' => ['required', 'in:male,female,non-binary'],
            'agreement' => ['required']
        ];
    }
}
