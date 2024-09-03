<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RatingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
          
                'book_id' => 'required|exists:books,id',
                'user_id' => 'sometimes|exists:users,id',
                'rating' => 'required|integer|min:1|max:5',
                'review' => 'nullable|string',
         
        ];
    }
    protected function prepareForValidation()
    { 
    $this->merge([
        'user_id' => auth()->id(),
    ]);
    }
}
