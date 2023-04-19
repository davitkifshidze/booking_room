<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestUser extends FormRequest
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

        $id = $this->route('id');

        if ($this->isMethod('post')) {
            return [
                'name' => 'required|string|min:2|max:25|regex:/^[\p{L}]+$/u',
                'surname' => 'required|string|min:3|max:25|regex:/^[\p{L}]+$/u',
                'personal_number' => 'required|numeric|digits:11|unique:users,personal_number',
                'password' => 'required|string|min:8',
            ];
        } else {
            return [
                'name' => 'required|string|min:2|max:25|regex:/^[\p{L}\s]+$/u',
                'surname' => 'required|string|min:3|max:25|regex:/^[\p{L}\s]+$/u',
                'personal_number' => [
                    'required',
                    'numeric',
                    'digits:11',
                    Rule::unique('users', 'personal_number')->ignore($id)
                ],
                'password' => 'nullable|string|min:8',
            ];
        }

    }
}
