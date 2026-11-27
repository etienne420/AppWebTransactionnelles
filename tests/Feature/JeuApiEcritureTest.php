<?php

namespace Tests\Feature;

use App\Models\Jeu;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class JeuApiEcritureTest extends TestCase
{
    use RefreshDatabase;

    // ----- Création -----

    public function test_un_visiteur_sans_jeton_ne_peut_pas_creer_de_jeu(): void
    {
        $this->postJson('/api/jeux', ['titre' => 'Jeu pirate'])
            ->assertUnauthorized();

        $this->assertDatabaseCount('jeux', 0);
    }

    public function test_la_creation_utilise_le_compte_connecte(): void
    {
        $user = User::factory()->create();
        $autre = User::factory()->create();
        Sanctum::actingAs($user);

        $this->postJson('/api/jeux', [
            'titre' => 'Hollow Knight',
            'genre' => 'Metroidvania',
            'annee_sortie' => 2017,
            'user_id' => $autre->id,
        ])->assertCreated()
          ->assertJsonPath('data.titre', 'Hollow Knight')
          ->assertJsonPath('data.user.id', $user->id);

        $this->assertDatabaseHas('jeux', [
            'titre' => 'Hollow Knight',
            'user_id' => $user->id,
        ]);
    }

    public function test_une_creation_invalide_retourne_422(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $this->postJson('/api/jeux', [
            'titre' => '',
            'annee_sortie' => 'abc',
        ])->assertUnprocessable()
          ->assertJsonValidationErrors(['titre', 'annee_sortie']);

        $this->assertDatabaseCount('jeux', 0);
    }

    public function test_un_jeu_peut_etre_cree_avec_une_image(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $this->post('/api/jeux', [
            'titre' => 'Jeu illustré',
            'image' => UploadedFile::fake()->image('jaquette.png'),
        ], ['Accept' => 'application/json'])->assertCreated();

        $jeu = Jeu::firstOrFail();
        $this->assertNotNull($jeu->image_path);
        Storage::disk('public')->assertExists($jeu->image_path);
    }

    // ----- Modification (PUT) -----

    public function test_le_proprietaire_peut_modifier_son_jeu(): void
    {
        $owner = User::factory()->create();
        $jeu = Jeu::factory()->create(['user_id' => $owner->id]);
        Sanctum::actingAs($owner);

        $this->putJson("/api/jeux/{$jeu->id}", ['titre' => 'Titre modifié'])
            ->assertOk()
            ->assertJsonPath('data.titre', 'Titre modifié');

        $this->assertDatabaseHas('jeux', [
            'id' => $jeu->id,
            'titre' => 'Titre modifié',
            'user_id' => $owner->id,
        ]);
    }

    public function test_un_autre_compte_ne_peut_pas_modifier_le_jeu(): void
    {
        $jeu = Jeu::factory()->create();
        Sanctum::actingAs(User::factory()->create());

        $this->putJson("/api/jeux/{$jeu->id}", ['titre' => 'Tentative'])
            ->assertForbidden();

        $this->assertDatabaseHas('jeux', [
            'id' => $jeu->id,
            'titre' => $jeu->titre,
            'user_id' => $jeu->user_id,
        ]);
    }

    public function test_un_visiteur_sans_jeton_ne_peut_pas_modifier_le_jeu(): void
    {
        $jeu = Jeu::factory()->create();

        $this->putJson("/api/jeux/{$jeu->id}", ['titre' => 'Tentative'])
            ->assertUnauthorized();

        $this->assertDatabaseHas('jeux', ['id' => $jeu->id, 'titre' => $jeu->titre]);
    }

    public function test_une_modification_invalide_retourne_422(): void
    {
        $owner = User::factory()->create();
        $jeu = Jeu::factory()->create(['user_id' => $owner->id]);
        Sanctum::actingAs($owner);

        $this->putJson("/api/jeux/{$jeu->id}", ['annee_sortie' => 'abc'])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('annee_sortie');

        $this->assertDatabaseHas('jeux', [
            'id' => $jeu->id,
            'annee_sortie' => $jeu->annee_sortie,
        ]);
    }

    public function test_modifier_un_jeu_absent_retourne_404(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $this->putJson('/api/jeux/999999', ['titre' => 'Fantôme'])
            ->assertNotFound();
    }

    // ----- Suppression -----

    public function test_le_proprietaire_peut_supprimer_son_jeu(): void
    {
        $owner = User::factory()->create();
        $jeu = Jeu::factory()->create(['user_id' => $owner->id]);
        Sanctum::actingAs($owner);

        $this->deleteJson("/api/jeux/{$jeu->id}")
            ->assertNoContent();

        $this->assertDatabaseMissing('jeux', ['id' => $jeu->id]);
    }

    public function test_un_autre_compte_ne_peut_pas_supprimer_le_jeu(): void
    {
        $jeu = Jeu::factory()->create();
        Sanctum::actingAs(User::factory()->create());

        $this->deleteJson("/api/jeux/{$jeu->id}")
            ->assertForbidden();

        $this->assertDatabaseHas('jeux', ['id' => $jeu->id]);
    }

    public function test_un_visiteur_sans_jeton_ne_peut_pas_supprimer_le_jeu(): void
    {
        $jeu = Jeu::factory()->create();

        $this->deleteJson("/api/jeux/{$jeu->id}")
            ->assertUnauthorized();

        $this->assertDatabaseHas('jeux', ['id' => $jeu->id]);
    }
}