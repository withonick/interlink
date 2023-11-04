<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'firstname' => 'required | string | max: 255',
            'surname' => 'max: 255',
            'username' => 'required | string | max: 255',
            'email' => 'required | email | max: 255',
            'password' => 'required | min: 6',
            'day' => 'integer | min: 1 | max: 31',
            'month' => 'integer | min: 1 | max: 12',
            'year' => 'integer |min: 1900 | max: 2021',
        ];
    }
}
