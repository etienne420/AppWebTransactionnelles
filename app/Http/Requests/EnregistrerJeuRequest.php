<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnregistrerJeuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => ['required', 'string', 'max:150'],
            'genre' => ['nullable', 'string', 'max:100'],
            'annee_sortie' => ['nullable', 'integer', 'min:1', 'max:65535'],
            'description' => ['nullable', 'string'],
        ];
    }
}