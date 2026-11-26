<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConnexionTest extends TestCase
{
    use RefreshDatabase;

    public function test_une_personne_peut_se_connecter_avec_les_bons_identifiants(): void
    {
        $user = User::factory()->create();

        $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'password',
        ])->assertRedirect(route('jeux.index'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_un_mauvais_mot_de_passe_est_refuse(): void
    {
        $user = User::factory()->create();

        $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'mauvais-mot-de-passe',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_les_tentatives_de_connexion_sont_limitees(): void
    {
        $user = User::factory()->create();
        $identifiants = ['email' => $user->email, 'password' => 'mauvais'];

        for ($i = 0; $i < 6; $i++) {
            $this->post(route('login.store'), $identifiants)->assertRedirect();
        }

        $this->post(route('login.store'), $identifiants)
            ->assertTooManyRequests();

        $this->assertGuest();
    }

    public function test_une_personne_connectee_ne_revoit_pas_le_formulaire_de_connexion(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('login'))
            ->assertRedirect(route('home'));
    }

    public function test_la_deconnexion_ferme_la_session(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('logout'))
            ->assertRedirect(route('jeux.index'));

        $this->assertGuest();
    }
}