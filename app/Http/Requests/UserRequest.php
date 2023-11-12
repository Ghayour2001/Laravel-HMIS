<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Change to true if authorization is not required
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'dob' => 'required|date',
            'cnic' => 'required|string',
            'department_id' => 'required',
            'qualification' => 'required|string',
            'probation_period' => 'required',
            'contact_no' => 'required|string',
            'position' => 'required|string',
            'address' => 'required|string',
            'password' => 'required|string|min:8',
        ];
    }
}

