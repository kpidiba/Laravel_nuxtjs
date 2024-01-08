<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacheRegisterRequest extends FormRequest
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
            'titre' => ['required', 'string', 'min:2', 'max:255','unique:taches,titre'],
            'description' => ['required', 'string', 'min:5', 'max:255'],
            'priorite' => ['required'],
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
            'titre.required' => 'Entrez le titre',
            'titre.string' => 'Entrez une chaine de caracteres',
            'titre.min' => 'Le taille minimum du nom est de 2 caracteres',
            'titre.max' => 'La taille maximal du nom est de 255 caracteres',
            'titre.unique' => 'Veuillez changer de titre',
            'description.required' => 'Entrez la description',
            'description.string' => 'Entrez une chaine de caracteres',
            'description.min' => 'Le taille minimum du nom est de 2 caracteres',
            'description.max' => 'La taille maximal du nom est de 255 caracteres',
            'priorite.required' => 'Veuillez Entrez la priorite'
        ];
    }
}
