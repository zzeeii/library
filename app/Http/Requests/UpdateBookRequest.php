<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->isAdmin();
        //return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'sometimes|nullable|string|max:255',
            'author' => 'sometimes|nullable|string|max:255',
            'description' => 'sometimes|nullable|string',
            'published_at' => 'sometimes|nullable|date',
            'category' => 'sometimes|nullable|string|max:255',
            'is_available' => 'sometimes|nullable|boolean',
        ];
    }
}
