<?php


function getJeux(PDO $pdo): array
{
    $requete = $pdo->query(
        "SELECT id_jeu, titre, annee_sortie, genre
        FROM jeu"
    );

    return $requete->fetchAll(PDO::FETCH_ASSOC);
}