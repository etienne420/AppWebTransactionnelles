<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Jeu;
use Illuminate\Support\Facades\Gate;


class EnregistrerJeuApiRequest extends FormRequest
{
public function authorize(): bool
{
    if ($this->isMethod('post')) {
        return Gate::allows('create', Jeu::class);
    }

    return Gate::allows('update', $this->route('jeu'));
}

public function rules(): array
{
    $presence = $this->isMethod('post') ? 'required' : 'sometimes';

    return [
        'titre' => [$presence, 'string', 'max:150'],
        'genre' => ['sometimes', 'nullable', 'string', 'max:100'],
        'annee_sortie' => ['sometimes', 'nullable', 'integer', 'min:1', 'max:65535'],
        'description' => ['sometimes', 'nullable', 'string'],
        'image' => ['sometimes', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
    ];
}
}
