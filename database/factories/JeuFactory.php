<?php

namespace Database\Factories;

use App\Models\Jeu;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Jeu>
 */
class JeuFactory extends Factory
{
    protected $model = Jeu::class;

    public function definition(): array
    {
        return [
            'titre' => fake()->unique()->words(3, true),
            'genre' => fake()->randomElement(['Action', 'Aventure', 'Plateforme', 'Stratégie', 'RPG']),
            'annee_sortie' => fake()->numberBetween(1985, 2026),
            'description' => fake()->sentence(),
            'image_path' => null,
            'user_id' => User::factory(),
        ];
    }
}