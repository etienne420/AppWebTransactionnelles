<?php

namespace Tests\Feature;

use App\Models\Jeu;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JeuApiLectureTest extends TestCase
{
    use RefreshDatabase;

    public function test_la_liste_est_publique_et_respecte_le_contrat_json(): void
    {
        Jeu::factory()->count(2)->create();

        $this->getJson('/api/jeux')
            ->assertOk()
            ->assertJsonCount(2, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'titre', 'genre', 'annee_sortie', 'description', 'image_path', 'user' => ['id', 'name']],
                ],
                'links',
                'meta',
            ])
            ->assertJsonMissingPath('data.0.user.email');
    }

    public function test_la_liste_est_paginee_par_10(): void
    {
        Jeu::factory()->count(12)->create();

        $this->getJson('/api/jeux')
            ->assertOk()
            ->assertJsonCount(10, 'data')
            ->assertJsonPath('meta.total', 12)
            ->assertJsonPath('meta.last_page', 2);
    }

    public function test_le_detail_retourne_le_jeu_et_son_proprietaire(): void
    {
        $jeu = Jeu::factory()->create(['titre' => 'Celeste']);

        $this->getJson("/api/jeux/{$jeu->id}")
            ->assertOk()
            ->assertJsonPath('data.id', $jeu->id)
            ->assertJsonPath('data.titre', 'Celeste')
            ->assertJsonPath('data.user.id', $jeu->user_id);
    }

    public function test_un_jeu_absent_retourne_404(): void
    {
        $this->getJson('/api/jeux/999999')->assertNotFound();
    }

    public function test_les_lectures_sont_limitees_a_60_par_minute(): void
    {
        for ($i = 0; $i < 60; $i++) {
            $this->getJson('/api/jeux')->assertOk();
        }

        $this->getJson('/api/jeux')->assertTooManyRequests();
    }
}