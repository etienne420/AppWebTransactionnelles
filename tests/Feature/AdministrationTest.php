<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdministrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_un_visiteur_est_redirige_vers_la_connexion(): void
    {
        $this->get(route('admin.index'))
            ->assertRedirect(route('login'));
    }

    public function test_un_membre_recoit_un_refus(): void
    {
        $membre = User::factory()->create();

        $this->actingAs($membre)
            ->get(route('admin.index'))
            ->assertForbidden();
    }

    public function test_un_responsable_voit_la_liste_des_comptes(): void
    {
        $responsable = User::factory()->manager()->create();
        User::factory()->create(['email' => 'membre@example.test']);

        $this->actingAs($responsable)
            ->get(route('admin.index'))
            ->assertOk()
            ->assertSee('membre@example.test');
    }

    public function test_le_lien_administration_n_est_affiche_qu_au_responsable(): void
    {
        $membre = User::factory()->create();
        $responsable = User::factory()->manager()->create();

        $this->actingAs($membre)
            ->get(route('home'))
            ->assertDontSee(route('admin.index'));

        $this->actingAs($responsable)
            ->get(route('home'))
            ->assertSee(route('admin.index'));
    }
}