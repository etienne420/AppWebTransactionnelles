<?php

namespace Tests\Feature;

use App\Models\Jeu;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConsultationJeuTest extends TestCase
{
    use RefreshDatabase;

    public function test_un_visiteur_voit_la_liste_publique_des_jeux(): void
    {
        Jeu::factory()->create(['titre' => 'Celeste']);
        Jeu::factory()->create(['titre' => 'Hades']);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Celeste')
            ->assertSee('Hades');
    }

    public function test_un_visiteur_peut_consulter_le_detail_d_un_jeu(): void
    {
        $jeu = Jeu::factory()->create(['titre' => 'Celeste', 'genre' => 'Plateforme']);

        $this->get(route('jeux.show', $jeu))
            ->assertOk()
            ->assertSee('Celeste')
            ->assertSee('Plateforme');
    }

    public function test_un_jeu_inexistant_retourne_404(): void
    {
        $this->get('/jeux/999999')->assertNotFound();
    }

    public function test_un_visiteur_ne_voit_pas_les_liens_d_ecriture(): void
    {
        $jeu = Jeu::factory()->create();

        $this->get(route('home'))
            ->assertOk()
            ->assertDontSee(route('jeux.create'));

        $this->get(route('jeux.show', $jeu))
            ->assertOk()
            ->assertDontSee(route('jeux.edit', $jeu));
    }

    public function test_la_recherche_retourne_les_jeux_correspondants_en_json(): void
    {
        Jeu::factory()->create(['titre' => 'The Legend of Zelda']);
        Jeu::factory()->create(['titre' => 'Hades']);

        $this->getJson(route('recherche.jeux', ['q' => 'Zelda']))
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.label', 'The Legend of Zelda');
    }

    public function test_une_recherche_trop_courte_est_refusee(): void
    {
        $this->getJson(route('recherche.jeux', ['q' => 'a']))
            ->assertUnprocessable()
            ->assertJsonValidationErrors('q');
    }
}