<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentCardRequest extends FormRequest
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
        $studentCard = $this->route('student_card');

        $cardId = $studentCard ? (is_object($studentCard) ? $studentCard->id : $studentCard) : null;

        return [
            'card_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('student_cards', 'card_number')->ignore($cardId),
            ],

            'issue_date' => ['required', 'date'],

            'student_id' => [
                'required',
                'integer',
                'exists:students,id',
                Rule::unique('student_cards', 'student_id')->ignore($cardId),
            ],
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
