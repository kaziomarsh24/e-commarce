<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSubcategoryRequest extends FormRequest
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
        $subcategory = $this->route('subcategory');

        return [
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'name'        => [
                'required',
                'string',
                'max:255',
                Rule::unique('subcategories', 'name')
                    ->where('category_id', $this->category_id)
                    ->ignore($subcategory),
            ],
            'is_active'   => ['nullable', 'boolean'],
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'category_id.required' => 'Please select a parent category.',
            'category_id.exists'   => 'The selected category does not exist.',
            'name.unique'          => 'This subcategory name already exists under the selected category.',
        ];
    }
}
