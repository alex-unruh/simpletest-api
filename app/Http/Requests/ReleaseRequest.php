<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReleaseRequest extends FormRequest
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
            'product_id' => ['required', 'exists:products,id'],
            'version' => ['required', 'regex:#^\d+(\.\d+)+$#'],
            'changelog' => ['required', 'string', 'between:4,65535'],
            'status' => ['required', 'in:1,2,3,4'],
            'released_by' => ['required', 'exists:users,id'],
            'aproved_by' => ['nullable', 'exists:users,id']
         ];
    }
}
