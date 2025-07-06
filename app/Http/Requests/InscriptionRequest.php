<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InscriptionRequest extends FormRequest
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
            'nom'=>'required',
            'email'=> 'required|email|unique:users',
            'pseudos' => [
                'required',
                'min:8',
            ],
            'password' => [
                'required',
                'string',
                'min:8', // Au moins 8 caractères
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            ],
            'statut' => 'required|in:utilisateur,auteur,SuperAdmin',
            'cgu' => 'accepted',
            ];
    }
    public function messages()
    {
        return [
            'nom.required' => 'Le nom est requis',
            'email.required' => 'Le mail est requis',
            'email.unique' => 'Cet email est déjà lié à un compte',
            'pseudos.required' => 'Le pseudos est requis',
            'pseudos.min' => 'Le mot de passe doit contenir plus de 8 caratères',
            'password.required' => 'Le mot de passe requis',
            'password.min' => 'Le mot de passe doit contenir plus de 8 caratères',
            'password.regex' => 'Le mot de passe doit contenir au moins une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial.',
            'statut.required' => 'Le statut est requis',
            'statut.in' => 'Les statut sont: utilisateur ou auteur',
        ];

    }
}
