<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $category = $this->route('category');
        return [
            'name'        => ['required', 'string', 'max:255', Rule::unique('categories', 'name')->ignore($category)],
            'image'       => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'description' => ['nullable', 'string'],
            'is_active'   => ['nullable', 'boolean'],
        ];
    }
}
