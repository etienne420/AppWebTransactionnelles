<?php

namespace Tests\Unit;

use App\Models\Jeu;
use App\Models\User;
use App\Policies\JeuPolicy;
use PHPUnit\Framework\TestCase;

class JeuPolicyTest extends TestCase
{
    private function compte(int $id, string $role = User::ROLE_MEMBER): User
    {
        $user = new User();
        $user->id = $id;
        $user->role = $role;

        return $user;
    }

    private function jeuAppartenantA(?int $userId): Jeu
    {
        $jeu = new Jeu();
        $jeu->user_id = $userId;

        return $jeu;
    }

    public function test_le_proprietaire_peut_modifier_son_jeu(): void
    {
        $policy = new JeuPolicy();

        $this->assertTrue($policy->update($this->compte(1), $this->jeuAppartenantA(1)));
    }

    public function test_un_autre_compte_ne_peut_pas_modifier_le_jeu(): void
    {
        $policy = new JeuPolicy();

        $this->assertFalse($policy->update($this->compte(2), $this->jeuAppartenantA(1)));
    }

    public function test_un_responsable_ne_peut_pas_modifier_le_jeu_d_un_autre(): void
    {
        $policy = new JeuPolicy();
        $responsable = $this->compte(2, User::ROLE_MANAGER);

        $this->assertFalse($policy->update($responsable, $this->jeuAppartenantA(1)));
    }

    public function test_la_suppression_suit_la_regle_de_modification(): void
    {
        $policy = new JeuPolicy();
        $jeu = $this->jeuAppartenantA(1);

        $this->assertTrue($policy->delete($this->compte(1), $jeu));
        $this->assertFalse($policy->delete($this->compte(2), $jeu));
    }

    public function test_un_jeu_sans_proprietaire_ne_peut_etre_modifie_par_personne(): void
    {
        $policy = new JeuPolicy();

        $this->assertFalse($policy->update($this->compte(1), $this->jeuAppartenantA(null)));
    }
}