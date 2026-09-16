<?php


function getJeux(PDO $pdo): array
{
    $requete = $pdo->query(
        "SELECT id_jeu, titre, annee_sortie, genre
        FROM jeu"
    );

    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

function addJeux(PDO $pdo, string $titre, int $annee_sortie, string $genre): void
{
    $requete = $pdo->prepare(
        "INSERT INTO jeu (titre, annee_sortie, genre)
        VALUES (:titre, :annee_sortie, :genre)"
    );

    $requete->execute([
        ':titre' => $titre,
        ':annee_sortie' => $annee_sortie,
        ':genre' => $genre
    ]);
}

function deleteJeux(PDO $pdo, int $id_jeu): void
{
    $requete = $pdo->prepare(
        "DELETE FROM jeu WHERE id_jeu = :id_jeu"
    );

    $requete->execute([
        ':id_jeu' => $id_jeu
    ]);
}