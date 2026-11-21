<?php

namespace Tests\Feature;

use App\Models\Jeu;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImageJeuTest extends TestCase
{
    use RefreshDatabase;

    public function test_un_jeu_peut_recevoir_une_image(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('jeux.store'), [
            'titre' => 'Jeu illustré',
            'image' => UploadedFile::fake()->image('jaquette.png'),
        ])->assertRedirect(route('jeux.index'));

        $jeu = Jeu::firstOrFail();
        $this->assertNotNull($jeu->image_path);
        Storage::disk('public')->assertExists($jeu->image_path);
    }

    public function test_un_fichier_qui_n_est_pas_une_image_est_refuse(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('jeux.store'), [
            'titre' => 'Jeu avec texte',
            'image' => UploadedFile::fake()->create('notes.txt', 10, 'text/plain'),
        ])->assertSessionHasErrors('image');

        $this->assertDatabaseCount('jeux', 0);
        $this->assertEmpty(Storage::disk('public')->allFiles());
    }

    public function test_une_nouvelle_image_remplace_l_ancienne(): void
    {
        $owner = User::factory()->create();
        Storage::disk('public')->put('jeux/ancienne.png', 'ancienne');
        $jeu = Jeu::factory()->create([
            'user_id' => $owner->id,
            'image_path' => 'jeux/ancienne.png',
        ]);

        $this->actingAs($owner)->patch(route('jeux.update', $jeu), [
            'titre' => $jeu->titre,
            'image' => UploadedFile::fake()->image('nouvelle.png'),
        ])->assertRedirect(route('jeux.show', $jeu));

        $jeu->refresh();
        Storage::disk('public')->assertMissing('jeux/ancienne.png');
        Storage::disk('public')->assertExists($jeu->image_path);
    }

    public function test_un_autre_compte_ne_peut_pas_televerser_d_image_sur_le_jeu(): void
    {
        $jeu = Jeu::factory()->create();
        $autre = User::factory()->create();

        $this->actingAs($autre)->patch(route('jeux.update', $jeu), [
            'titre' => $jeu->titre,
            'image' => UploadedFile::fake()->image('fake.png'),
        ])->assertForbidden();

        $this->assertNull($jeu->fresh()->image_path);
        $this->assertEmpty(Storage::disk('public')->allFiles());
    }
}