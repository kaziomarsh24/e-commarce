<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
        $product = $this->route('product');

        return [
            'category_id'      => ['required', 'integer', 'exists:categories,id'],
            'subcategory_id'   => ['required', 'integer', 'exists:subcategories,id'],
            'name'             => ['required', 'string', 'max:255', Rule::unique('products', 'name')->ignore($product)],
            'old_price'        => ['nullable', 'numeric', 'min:0'],
            'new_price'        => ['required', 'numeric', 'min:0'],
            'description'      => ['required', 'string'],
            'image'            => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'gallery_images'   => ['nullable', 'array'],
            'gallery_images.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'is_active'        => ['nullable', 'boolean'],
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'category_id.required'    => 'Please select a category.',
            'subcategory_id.required' => 'Please select a subcategory.',
            'name.required'           => 'Please enter the product name.',
            'name.unique'             => 'This product name already exists.',
            'new_price.required'      => 'Please enter the price.',
            'description.required'    => 'Please enter the product description.',
        ];
    }
}
