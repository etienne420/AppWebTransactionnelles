<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Le rôle n'est pas dans $fillable : on l'attribue avec forceFill()
        User::firstOrCreate(
            ['email' => 'membre@example.com'],
            ['name' => 'Membre Test', 'password' => 'password']
        )->forceFill(['role' => User::ROLE_MEMBER])->save();

        User::firstOrCreate(
            ['email' => 'responsable@example.com'],
            ['name' => 'Responsable Test', 'password' => 'password']
        )->forceFill(['role' => User::ROLE_MANAGER])->save();
    }
}
