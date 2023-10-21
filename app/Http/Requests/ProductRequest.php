<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'title' => ['required', 'string', 'between:4,255'],
            'slug' => ['required', 'string', 'between:4,255', Rule::unique('products')->ignore($this->id)],
            'type' => ['required', 'in:1,2'],
            'parent_id' => ['required_if:type,2', 'exists:products,id'],
            'description' => ['sometimes', 'string', 'between:4,65535']
        ];
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        return $this->merge([
            'slug' => Str::slug($this->title)
        ]);
    }
}
