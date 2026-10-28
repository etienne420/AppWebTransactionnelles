<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jeu extends Model
{
    protected $table = 'jeux';

    protected $fillable = [
        'titre',
        'genre',
        'annee_sortie',
        'description',
        'image_path',
    ];
}