<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateStudentCardRequest extends FormRequest
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
            'card_number' => ['required', 'string', 'max:255', 'unique:student_cards,card_number'],

            'issue_date' => ['required', 'date'],

            'student_id' => ['required', 'integer', 'exists:students,id'],

        ];
    }
    public function messages(): array
    {
        return [
            'card_number.required' => 'The card number field is required.',
            'card_number.unique' => 'This card number is already registered for another student.',
            'issue_date.required' => 'The issue date field is required.',
            'issue_date.date' => 'The issue date format is invalid.',
        ];
    }
}
