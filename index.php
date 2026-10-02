<?php

declare(strict_types=1);

require_once __DIR__ . '/Modeles/Modele.php';
require_once __DIR__ . '/Modeles/Jeu.php';
require_once __DIR__ . '/Modeles/Utilisateur.php';
require_once __DIR__ . '/services/Authentification.php';
require_once __DIR__ . '/Vues/Vue.php';
require_once __DIR__ . '/Controleurs/ControleurErreur.php';
require_once __DIR__ . '/Controleurs/ControleurAccueil.php';
require_once __DIR__ . '/Controleurs/ControleurJeux.php';
require_once __DIR__ . '/Controleurs/ControleurUtilisateur.php';
require_once __DIR__ . '/config/securite.php';
require_once __DIR__ . '/Routeur.php';

$vue = new Vue();
$controleurErreur = new ControleurErreur($vue);
demarrerSession();

try {
    require __DIR__ . '/config/bd.php';

    $authentification = new Authentification();
    $controleurAccueil = new ControleurAccueil($vue, $authentification);
    $modeleJeux = new Jeu($pdo);
    $controleurJeux = new ControleurJeux($modeleJeux, $vue, $controleurErreur);
    $modeleUtilisateurs = new Utilisateur($pdo);
    $controleurUtilisateur = new ControleurUtilisateur(
        $modeleUtilisateurs,
        $authentification,
        $vue,
        $controleurErreur
    );
    $routeur = new Routeur($controleurAccueil, $controleurJeux, $controleurUtilisateur, $controleurErreur);

    $action = $_GET['action'] ?? 'accueil';
    $methode = $_SERVER['REQUEST_METHOD'] ?? 'GET';

    $routeur->router($action, $methode);
} catch (Throwable $exception) {
    error_log($exception::class . ': ' . $exception->getMessage());
    $controleurErreur->page500();
}