<?php

require_once __DIR__ . '/../config/bd.php';
require_once __DIR__ . '/../Modeles/jeu-modele.php';

$action = $_GET['action'] ?? 'jeux';

if ($action === 'ajouter-jeu' && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $titre = trim($_POST['titre'] ?? '');
    $annee_sortie = (int) ($_POST['annee_sortie'] ?? 0);
    $genre = trim($_POST['genre'] ?? '');

    addJeux($pdo, $titre, $annee_sortie, $genre);

    header('Location: index.php?action=jeux');
    exit;
}

if ($action === 'supprimer-jeu' && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $idJeu = (int) ($_POST['id_jeu'] ?? 0);

    deleteJeux($pdo, $idJeu);

    header('Location: index.php?action=jeux');
    exit;
}

$jeux = getJeux($pdo);

require_once __DIR__ . '/../Vues/jeux/index.php';