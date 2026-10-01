<?php

declare(strict_types=1);

require_once __DIR__ . '/Modele.php';

class Jeu extends Modele
{
    public function lister(): array
    {
        return $this->executer(
            'SELECT id_jeu, titre, annee_sortie, genre
             FROM jeu'
        )->fetchAll();
    }

    public function ajouter(string $titre, int $annee_sortie, string $genre): void
    {
        $this->executer(
            'INSERT INTO jeu (titre, annee_sortie, genre)
             VALUES (:titre, :annee_sortie, :genre)',
            [
                'titre' => $titre,
                'annee_sortie' => $annee_sortie,
                'genre' => $genre,
            ]
        );
    }

    public function supprimer(int $id_jeu): void
    {
        $this->executer(
            'DELETE FROM jeu
             WHERE id_jeu = :id_jeu',
            ['id_jeu' => $id_jeu]
        );
    }
}