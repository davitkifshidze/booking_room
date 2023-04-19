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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:25|regex:/^[\p{L}]+$/u',
            'surname' => 'required|string|min:3|max:25|regex:/^[\p{L}]+$/u',
            'personal_number' => 'required|numeric|digits:11|unique:users,personal_number',
            'password' => 'required|string|min:8',
        ];
    }
}
