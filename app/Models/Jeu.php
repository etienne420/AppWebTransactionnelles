<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jeu extends Model
{
    protected $table = 'jeux';

    protected $fillable = [
        'titre',
        'genre',
        'annee_sortie',
        'description',
        'image_path',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
