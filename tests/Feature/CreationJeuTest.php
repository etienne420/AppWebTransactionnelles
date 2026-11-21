<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreationJeuTest extends TestCase
{
    use RefreshDatabase;

    public function test_une_personne_connectee_peut_creer_un_jeu(): void
    {
        // Préparer
        $user = User::factory()->create();

        // Agir
        $response = $this->actingAs($user)->post(route('jeux.store'), [
            'titre' => 'Jeu testé',
            'genre' => 'Aventure',
            'annee_sortie' => 2020,
        ]);

        // Vérifier
        $response->assertRedirect(route('jeux.index'));
        $this->assertDatabaseHas('jeux', [
            'titre' => 'Jeu testé',
            'user_id' => $user->id,
        ]);
    }

    public function test_le_proprietaire_vient_de_la_session_et_non_du_formulaire(): void
    {
        $user = User::factory()->create();
        $autre = User::factory()->create();

        $this->actingAs($user)->post(route('jeux.store'), [
            'titre' => 'Jeu usurpé',
            'user_id' => $autre->id,
        ])->assertRedirect(route('jeux.index'));

        $this->assertDatabaseHas('jeux', [
            'titre' => 'Jeu usurpé',
            'user_id' => $user->id,
        ]);
    }

    public function test_un_titre_vide_est_refuse(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('jeux.store'), ['titre' => ''])
            ->assertSessionHasErrors('titre');

        $this->assertDatabaseCount('jeux', 0);
    }

    public function test_une_annee_invalide_est_refusee(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('jeux.store'), [
                'titre' => 'Jeu',
                'annee_sortie' => 'abc',
            ])
            ->assertSessionHasErrors('annee_sortie');

        $this->assertDatabaseCount('jeux', 0);
    }

    public function test_un_visiteur_ne_peut_pas_creer_de_jeu(): void
    {
        $this->get(route('jeux.create'))
            ->assertRedirect(route('login'));

        $this->post(route('jeux.store'), ['titre' => 'Jeu anonyme'])
            ->assertRedirect(route('login'));

        $this->assertDatabaseCount('jeux', 0);
    }
}