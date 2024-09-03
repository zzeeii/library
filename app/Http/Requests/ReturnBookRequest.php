<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Carbon;

class ReturnBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
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
            'book_id' => 'required|exists:books,id',
            'user_id' => 'sometimes|exists:users,id',
            'borrowed_at' => 'sometimes|nullable|date',
            'due_date' => 'sometimes|date|after:borrowed_at',
            'returned_at' => 'sometimes|nullable|date|after:borrowed_at',
        ];
    }

   protected function prepareForValidation()
    {
     
            $this->merge([
                'user_id' => auth()->id(),
              
            ]);
  
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

    protected function passedValidation()
    {
        $borrowedAt = Carbon::parse($this->input('borrowed_at', now()));
        $dueDate = Carbon::parse($this->input('due_date'));
        $returnedAt = $this->input('returned_at');

        
        if ($dueDate->diffInDays($borrowedAt) > 14 && is_null($returnedAt)) {
          
            $this->handleLateReturn();
        }
    }

    protected function handleLateReturn()
    {
        
    
        $newDueDate = Carbon::parse($this->input('due_date'))->addDays(7);
        $this->merge(['due_date' => $newDueDate->toDateString()]);


 
        // Notification::send($this->user(), new LateReturnNotification());
   
        // $this->merge(['returned_at' => now()]);
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

