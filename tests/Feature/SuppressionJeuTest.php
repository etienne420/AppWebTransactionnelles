<?php

namespace Tests\Feature;

use App\Models\Jeu;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SuppressionJeuTest extends TestCase
{
    use RefreshDatabase;

    public function test_le_proprietaire_peut_supprimer_son_jeu(): void
    {
        $owner = User::factory()->create();
        $jeu = Jeu::factory()->create(['user_id' => $owner->id]);

        $this->actingAs($owner)
            ->delete(route('jeux.destroy', $jeu))
            ->assertRedirect(route('jeux.index'));

        $this->assertDatabaseMissing('jeux', ['id' => $jeu->id]);
    }

    public function test_un_autre_compte_ne_peut_pas_supprimer_le_jeu(): void
    {
        $jeu = Jeu::factory()->create();
        $autre = User::factory()->create();

        $this->actingAs($autre)
            ->delete(route('jeux.destroy', $jeu))
            ->assertForbidden();

        $this->assertDatabaseHas('jeux', ['id' => $jeu->id]);
    }

    public function test_un_visiteur_ne_peut_pas_supprimer_de_jeu(): void
    {
        $jeu = Jeu::factory()->create();

        $this->delete(route('jeux.destroy', $jeu))
            ->assertRedirect(route('login'));

        $this->assertDatabaseHas('jeux', ['id' => $jeu->id]);
    }
}