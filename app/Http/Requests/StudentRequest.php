<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:students,email'],
            'age' => ['required', 'integer', 'min:18', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [

            'name.required' => 'The name field is required. Please enter a full name.',
            'name.string' => 'The name must be text.',
            'name.max' => 'The name cannot exceed 255 characters.',


            'email.required' => 'The email address is required.',
            'email.email' => 'Please enter a valid email format ( user@example.com).',
            'email.unique' => 'This email address is already taken. Please use a different one.',


            'age.required' => 'The age field is required.',
            'age.integer' => 'The age must be a whole number.',
            'age.min' => 'The minimum required age is 18.',
            'age.max' => 'The age cannot exceed 100.',
        ];
    }
}
