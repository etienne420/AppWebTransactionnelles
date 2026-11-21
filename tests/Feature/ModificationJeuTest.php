<?php

namespace Tests\Feature;

use App\Models\Jeu;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModificationJeuTest extends TestCase
{
    use RefreshDatabase;

    public function test_le_proprietaire_peut_ouvrir_le_formulaire_de_modification(): void
    {
        $owner = User::factory()->create();
        $jeu = Jeu::factory()->create(['user_id' => $owner->id]);

        $this->actingAs($owner)
            ->get(route('jeux.edit', $jeu))
            ->assertOk()
            ->assertSee($jeu->titre);
    }

    public function test_un_autre_compte_ne_peut_pas_ouvrir_le_formulaire(): void
    {
        $jeu = Jeu::factory()->create();
        $autre = User::factory()->create();

        $this->actingAs($autre)
            ->get(route('jeux.edit', $jeu))
            ->assertForbidden();
    }

    public function test_le_proprietaire_peut_modifier_son_jeu(): void
    {
        $owner = User::factory()->create();
        $jeu = Jeu::factory()->create(['user_id' => $owner->id]);

        $this->actingAs($owner)
            ->patch(route('jeux.update', $jeu), ['titre' => 'Titre modifié'])
            ->assertRedirect(route('jeux.show', $jeu));

        $this->assertDatabaseHas('jeux', [
            'id' => $jeu->id,
            'titre' => 'Titre modifié',
            'user_id' => $owner->id,
        ]);
    }

    public function test_un_autre_compte_ne_peut_pas_modifier_le_jeu(): void
    {
        $jeu = Jeu::factory()->create();
        $autre = User::factory()->create();

        $this->actingAs($autre)
            ->patch(route('jeux.update', $jeu), ['titre' => 'Tentative'])
            ->assertForbidden();

        $this->assertDatabaseHas('jeux', [
            'id' => $jeu->id,
            'titre' => $jeu->titre,
            'user_id' => $jeu->user_id,
        ]);
    }

    public function test_un_responsable_ne_peut_pas_modifier_le_jeu_d_un_autre(): void
    {
        $jeu = Jeu::factory()->create();
        $responsable = User::factory()->manager()->create();

        $this->actingAs($responsable)
            ->patch(route('jeux.update', $jeu), ['titre' => 'Tentative'])
            ->assertForbidden();

        $this->assertDatabaseHas('jeux', ['id' => $jeu->id, 'titre' => $jeu->titre]);
    }

    public function test_un_visiteur_est_redirige_vers_la_connexion(): void
    {
        $jeu = Jeu::factory()->create();

        $this->patch(route('jeux.update', $jeu), ['titre' => 'Tentative'])
            ->assertRedirect(route('login'));

        $this->assertDatabaseHas('jeux', ['id' => $jeu->id, 'titre' => $jeu->titre]);
    }

    public function test_le_lien_modifier_n_est_affiche_qu_au_proprietaire(): void
    {
        $owner = User::factory()->create();
        $autre = User::factory()->create();
        $jeu = Jeu::factory()->create(['user_id' => $owner->id]);

        $this->actingAs($owner)
            ->get(route('jeux.show', $jeu))
            ->assertSee(route('jeux.edit', $jeu));

        $this->actingAs($autre)
            ->get(route('jeux.show', $jeu))
            ->assertDontSee(route('jeux.edit', $jeu));
    }
}