<?php

namespace Tests\Feature;

use App\Models\Jeu;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BibliothequeTest extends TestCase
{
    use RefreshDatabase;

    public function test_visitors_can_browse_the_public_game_list(): void
    {
        Jeu::create(['titre' => 'Jeu public']);

        $this->get('/')
            ->assertOk()
            ->assertSee('Jeu public');
    }

    public function test_account_page_requires_authentication(): void
    {
        $this->get(route('account.show'))
            ->assertRedirect(route('login'));
    }

    public function test_library_is_private_and_games_can_be_added_and_removed(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $ownedGame = Jeu::create(['titre' => 'Jeu de ma bibliothèque']);
        $otherGame = Jeu::create(['titre' => 'Jeu de l’autre compte']);

        $this->get(route('jeux.show', $ownedGame))
            ->assertOk()
            ->assertDontSee('Ajouter à ma bibliothèque');

        $this->actingAs($owner)
            ->get(route('jeux.show', $ownedGame))
            ->assertOk()
            ->assertSee(__('interface.add_to_library'));

        $this->actingAs($owner)
            ->post(route('bibliotheque.store', $ownedGame))
            ->assertRedirect();

        $this->assertDatabaseCount('librairies', 1);
        $this->actingAs($owner)
            ->post(route('bibliotheque.store', $ownedGame))
            ->assertRedirect();
        $this->assertDatabaseCount('librairies', 1);

        $this->actingAs($otherUser)
            ->post(route('bibliotheque.store', $otherGame))
            ->assertRedirect();

        $this->actingAs($owner)
            ->get(route('account.show'))
            ->assertOk()
            ->assertSee('Jeu de ma bibliothèque')
            ->assertDontSee('Jeu de l’autre compte')
            ->assertDontSee($otherUser->email);

        $this->actingAs($owner)
            ->delete(route('bibliotheque.destroy', $ownedGame))
            ->assertRedirect();

        $this->actingAs($owner)
            ->get(route('account.show'))
            ->assertDontSee('Jeu de ma bibliothèque');

        $this->assertDatabaseHas('librairies', [
            'user_id' => $otherUser->id,
            'jeu_id' => $otherGame->id,
        ]);
    }
}
