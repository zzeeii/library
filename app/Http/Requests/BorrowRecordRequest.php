<?php

namespace App\Http\Requests;

use App\Models\Borrow_record;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Carbon;

class BorrowRecordRequest extends FormRequest
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
            'borrowed_at' => 'sometimes|nullable|date',
            'due_date' => 'sometimes|date|after:borrowed_at',
            'returned_at' => 'sometimes|nullable|date|after:borrowed_at',
        ];
    }
    protected function prepareForValidation()
    { 
        $borrowedAt = $this->input('borrowed_at', now());

        
        $dueDate = Carbon::parse($borrowedAt)->addDays(14);
    if (!$this->has('borrowed_at')) {
        $this->merge([
            'user_id' => auth()->id(),
            'borrowed_at' => now(),
            'due_date'=> $dueDate->toDateString(),
        ]);
      }
    }
    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $bookId = $this->input('book_id');

            $isBookBorrowed = Borrow_record::where('book_id', $bookId)
                ->whereNull('returned_at')
                ->exists();

            if ($isBookBorrowed) {
                $validator->errors()->add('book_id', 'الكتاب غير متاح للاستعارة حالياً.');
            }
        });
    }
    public function messages()
    {
        return [
            'book_id.required' => 'معرف الكتاب مطلوب.',
            'book_id.exists' => 'الكتاب غير موجود.',
            'due_date.after' => 'تاريخ الإعادة يجب أن يكون بعد تاريخ الاستعارة.',
        ];
    }

    public function attributes()
    {
        return [
            'book_id' => 'معرف الكتاب',
            'borrowed_at' => 'تاريخ الاستعارة',
            'due_date' => 'تاريخ الإعادة',
            'returned_at' => 'تاريخ الإرجاع',
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