<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array  
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique('categories', 'name')->ignore($this->category)
            ]
        ];
    }

     public function messages(): array
    {
        return [
            'name.required' => 'The category name is required.',
            'name.string' => 'The brand name must be string.',
            'name.max' => 'The category name must not be more than 255 characters.',
            'name.unique' => 'This category name is already in use.',
        ];
    }
}
