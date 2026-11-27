<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JeuApiConnexionTest extends TestCase
{
    use RefreshDatabase;

    public function test_la_connexion_retourne_un_jeton(): void
    {
        $user = User::factory()->create();

        $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ])->assertOk()->assertJsonStructure(['token']);

        $this->assertDatabaseCount('personal_access_tokens', 1);
    }

    public function test_une_connexion_invalide_retourne_422_sans_jeton(): void
    {
        $user = User::factory()->create();

        $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'mauvais-mot-de-passe',
        ])->assertUnprocessable()->assertJsonValidationErrors('email');

        $this->assertDatabaseCount('personal_access_tokens', 0);
    }

    public function test_un_vrai_jeton_permet_d_ecrire_puis_la_deconnexion_le_revoque(): void
    {
        $user = User::factory()->create();
        $jeton = $user->createToken('test')->plainTextToken;

        $this->withToken($jeton)
            ->postJson('/api/jeux', ['titre' => 'Créé avec un jeton'])
            ->assertCreated();

        $this->withToken($jeton)
            ->postJson('/api/logout')
            ->assertNoContent();

        $this->assertDatabaseCount('personal_access_tokens', 0);

        // Oublier le compte gardé en mémoire entre deux requêtes du même test
        $this->app['auth']->forgetGuards();

        $this->withToken($jeton)
            ->postJson('/api/jeux', ['titre' => 'Après déconnexion'])
            ->assertUnauthorized();

        $this->assertDatabaseMissing('jeux', ['titre' => 'Après déconnexion']);
    }
}