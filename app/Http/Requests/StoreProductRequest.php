<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required','string'],
            'code' => [
                'required',
                'string',
                Rule::unique('products', 'code')->ignore($this->product)
            ],
            'category_id' => ['required','exists:categories,id'],
            'brand_id' => ['required','exists:brands,id'],
            'price' => ['required','numeric'],
            'quantity' => ['required','integer'],
            'image' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
            'description' => ['required']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The product name is required.',
            'name.string' => 'The product name must be a valid string.',

            'code.required' => 'The product code is required.',
            'code.unique' => 'This product code already exists.',

            'category_id.required' => 'Please select a category.',
            'category_id.exists' => 'The selected category is invalid.',

            'brand_id.required' => 'Please select a brand.',
            'brand_id.exists' => 'The selected brand is invalid.',

            'price.required' => 'The product price is required.',
            'price.numeric' => 'The price must be a number.',

            'quantity.required' => 'The quantity is required.',
            'quantity.integer' => 'The quantity must be an integer.',

            'image.required' => 'Please upload a product image.',
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'The image must be a type of jpeg, png, jpg, gif, or svg.',
            'image.max' => 'The image size must not exceed 2MB.',

            'description.required' => 'The product description is required.',
        ];
    }
}
