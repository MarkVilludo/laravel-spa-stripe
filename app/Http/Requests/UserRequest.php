<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
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
            'name' => 'required|max:50',
            // I want to check the user if exists first
            // If exists, will pass the email for unique validation
            // This is efficient, rather than we creating another validation for create or update
            'email' => request()->route('user') 
                ? 'required|email|max:255|unique:users,email,' . request()->route('user')
                : 'required|email|max:255|unique:users,email',
            'password' => request()->route('user') ? 'nullable' : 'required|max:50'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json(['errors' => $validator->errors()], 422);
        
        throw new HttpResponseException($response);
    }
}
