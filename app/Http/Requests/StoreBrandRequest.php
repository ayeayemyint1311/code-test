<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
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
                Rule::unique('brands', 'name')->ignore($this->brand)
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The brand name is required.',
            'name.string' => 'The brand name must be string.',
            'name.max' => 'The brand name must not be more than 255 characters.',
            'name.unique' => 'This brand name is already in use.',
        ];
    }
}
