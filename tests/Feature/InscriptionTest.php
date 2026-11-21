<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class InscriptionTest extends TestCase
{
    use RefreshDatabase;

    private function donneesValides(array $remplacements = []): array
    {
        return array_merge([
            'name' => 'Compte test',
            'email' => 'nouveau@example.test',
            'email_confirmation' => 'nouveau@example.test',
            'password' => 'mot-de-passe-test',
            'password_confirmation' => 'mot-de-passe-test',
            'g-recaptcha-response' => 'jeton-test',
        ], $remplacements);
    }

    private function simulerCaptcha(bool $succes): void
    {
        Http::fake([
            'https://www.google.com/recaptcha/api/siteverify' =>
                Http::response(['success' => $succes], 200),
        ]);
    }

    public function test_un_captcha_valide_cree_un_compte_ordinaire(): void
    {
        $this->simulerCaptcha(true);

        $this->post(route('register.store'), $this->donneesValides())
            ->assertRedirect(route('jeux.index'));

        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'nouveau@example.test',
            'role' => User::ROLE_MEMBER,
        ]);
    }

    public function test_le_role_ne_peut_pas_etre_choisi_a_l_inscription(): void
    {
        $this->simulerCaptcha(true);

        $this->post(route('register.store'), $this->donneesValides([
            'role' => User::ROLE_MANAGER,
        ]))->assertRedirect(route('jeux.index'));

        $this->assertDatabaseHas('users', [
            'email' => 'nouveau@example.test',
            'role' => User::ROLE_MEMBER,
        ]);
    }

    public function test_un_captcha_refuse_empeche_l_inscription(): void
    {
        $this->simulerCaptcha(false);

        $this->post(route('register.store'), $this->donneesValides())
            ->assertSessionHasErrors('g-recaptcha-response');

        $this->assertGuest();
        $this->assertDatabaseMissing('users', ['email' => 'nouveau@example.test']);
    }

    public function test_une_inscription_sans_captcha_est_refusee(): void
    {
        $this->simulerCaptcha(true);

        $this->post(route('register.store'), $this->donneesValides([
            'g-recaptcha-response' => '',
        ]))->assertSessionHasErrors('g-recaptcha-response');

        Http::assertNothingSent();
        $this->assertDatabaseMissing('users', ['email' => 'nouveau@example.test']);
    }

    public function test_une_confirmation_de_courriel_differente_est_refusee(): void
    {
        $this->simulerCaptcha(true);

        $this->post(route('register.store'), $this->donneesValides([
            'email_confirmation' => 'autre@example.test',
        ]))->assertSessionHasErrors('email');

        Http::assertNothingSent();
        $this->assertDatabaseMissing('users', ['email' => 'nouveau@example.test']);
    }

    public function test_une_confirmation_de_mot_de_passe_differente_est_refusee(): void
    {
        $this->simulerCaptcha(true);

        $this->post(route('register.store'), $this->donneesValides([
            'password_confirmation' => 'autre-mot-de-passe',
        ]))->assertSessionHasErrors('password');

        $this->assertDatabaseMissing('users', ['email' => 'nouveau@example.test']);
    }

    public function test_une_personne_connectee_ne_revoit_pas_l_inscription(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('register'))
            ->assertRedirect(route('home'));
    }
}