<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BookRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'author' => 'required|string|min:3|max:255',
            'description' => 'nullable|string',
            'published_at' => 'required|date',
            'category' => 'required|string|max:255',
           'is_available' => 'required|boolean',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'اسم الكتاب مطلوب.',
            'author.required' => 'اسم المؤلف مطلوب ويجب أن يحتوي على أكثر من 3 حروف.',
            'author.min' => 'اسم المؤلف يجب أن يحتوي على 3 حروف على الأقل.',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'اسم الكتاب',
            'author' => 'اسم المؤلف',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'تحقق من المدخلات.',
            'errors' => $validator->errors()
        ], 422));
    }
}
