<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'password' => ['required', 'string', 'min:8']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Entrez le nom',
            'name.string' => 'Entrez une chaine de caracteres',
            'name.min' => 'Le taille minimum du nom est de 2 caracteres',
            'name.max' => 'La taille maximal du nom est de 255 caracteres',
            'password.required' => 'Entrez un mot de passe',
            'password.string' => 'Entrez une chaine de caracteres',
            'password.min' => 'La taille minimale du mot de passe est de 8 caracteres'
        ];
    }
}
