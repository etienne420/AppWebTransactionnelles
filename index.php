<?php

declare(strict_types=1);

$action = $_GET['action'] ?? 'accueil';

switch ($action){
    case 'accueil':
        require __DIR__ . '/Controleurs/accueil-controleur.php';
        break;

    case 'jeux':
        require __DIR__ . '/Controleurs/jeux-controleur.php';
        break;

    case 'ajouter-jeu':
        require __DIR__ . '/Controleurs/jeux-controleur.php';
        break;

    case 'supprimer-jeu':
        require __DIR__ . '/Controleurs/jeux-controleur.php';
        break;

    case 'recits':
        require __DIR__ . '/Vues/recits.php';
        break;

    default:
        http_response_code(404);
        require __DIR__ . '/Vues/erreur.php';
        break;
}