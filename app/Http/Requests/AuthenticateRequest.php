<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthenticateRequest extends FormRequest
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
            'email'=> 'required|email',
            'password' => 'required|min:8',
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Le mail est requis',
            'password.required' => 'Le mot de passe requis',
            'password.min' => 'Le mot de passe doit contenir plus de 8 caratères',
        ];

    }
}
