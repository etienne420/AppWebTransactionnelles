<?php

declare(strict_types=1);

require_once __DIR__ . '/Modeles/Modele.php';
require_once __DIR__ . '/Modeles/Jeu.php';
require_once __DIR__ . '/Vues/Vue.php';
require_once __DIR__ . '/Controleurs/ControleurErreur.php';
require_once __DIR__ . '/Controleurs/ControleurJeux.php';
require_once __DIR__ . '/Routeur.php';

$vue = new Vue();
$controleurErreur = new ControleurErreur($vue);

try {
    require __DIR__ . '/config/bd.php';
} catch (Throwable $exception) {
    $controleurErreur->page500();
    exit;
}

$modeleJeux = new Jeu($pdo);
$controleurJeux = new ControleurJeux($modeleJeux, $vue, $controleurErreur);
$routeur = new Routeur($controleurJeux, $controleurErreur);

$action = $_GET['action'] ?? 'jeux';
$methode = $_SERVER['REQUEST_METHOD'] ?? 'GET';

$routeur->router($action, $methode);