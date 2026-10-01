<?php

declare(strict_types=1);

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/Modeles/Modele.php';
require_once __DIR__ . '/Modeles/Jeu.php';
require_once __DIR__ . '/Vues/Vue.php';
require_once __DIR__ . '/Controleurs/ControleurErreur.php';
require_once __DIR__ . '/Controleurs/ControleurJeux.php';
require_once __DIR__ . '/Routeur.php';

$vue = new Vue();
$controleurErreur = new ControleurErreur($vue);

try {
    $pdo = new PDO(
        'mysql:host=' . DB_HOTE . ';dbname=' . DB_NOM . ';charset=utf8mb4',
        DB_UTILISATEUR,
        DB_MOT_DE_PASSE,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $exception) {
    $controleurErreur->page500();
    exit;
}

$modeleJeux = new Jeu($pdo);
$controleurJeux = new ControleurJeux($modeleJeux, $vue, $controleurErreur);
$routeur = new Routeur($controleurJeux, $controleurErreur);

$action = $_GET['action'] ?? 'jeux';
$methode = $_SERVER['REQUEST_METHOD'] ?? 'GET';

$routeur->router($action, $methode);