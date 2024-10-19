<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'image' => 'nullable|image',
            'email' => [
                'required',
                Rule::unique('users'),
            ],
            'password' => 'required',
            'role' => 'required',
            'is_active' => [
                'nullable',
                Rule::in([0,1])
            ]
        ];
    }
}
