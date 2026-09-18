<?php

declare(strict_types=1);

require_once __DIR__ . '/config/securite.php';

demarrerSession();

$action = $_GET['action'] ?? 'accueil';

switch ($action) {
    case 'accueil':
        require __DIR__ . '/Controleurs/accueil-controleur.php';
        break;

    case 'jeux':
        require __DIR__ . '/Controleurs/jeux-controleur.php';
        break;

    case 'form-jeu':
        require __DIR__ . '/Controleurs/form_jeu-controleur.php';
        break;

    case 'ajouter-jeu':
        require __DIR__ . '/Controleurs/jeux-controleur.php';

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo "Méthode non permise";
            break;
        }

        if (!verifierJetonCsrf($_POST['jeton_csrf'] ?? null)) {
            http_response_code(403);
            echo "Requête refusée";
            break;
        }

        break;

    case 'supprimer-jeu':
        require __DIR__ . '/Controleurs/jeux-controleur.php';
        break;

    case 'recits':
        require __DIR__ . '/Controleurs/recits-controleur.php';
        break;

    default:
        http_response_code(404);
        require __DIR__ . '/Vues/erreur.php';
        break;
}