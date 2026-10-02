<?php

declare(strict_types=1);

require_once __DIR__ . '/Modele.php';

class Utilisateur extends Modele
{
    public function trouverParIdentifiant(string $identifiant): ?array
    {
        $utilisateur = $this->executer(
            'SELECT id, nom, identifiant, mot_de_passe
             FROM utilisateurs
             WHERE identifiant = :identifiant',
            ['identifiant' => $identifiant]
        )->fetch();

        return $utilisateur ?: null;
    }
}
