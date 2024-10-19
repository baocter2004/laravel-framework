<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $id = $this->segment(2);
        // dd($id);
        return [
           'name' => 'required|max:255',
            'image' => 'nullable|image',
            'email' => [
                'required',
                Rule::unique('users')->ignore($id),
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
