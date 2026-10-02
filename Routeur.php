<?php

declare(strict_types=1);

class Routeur
{
    private ControleurAccueil $controleurAccueil;
    private ControleurJeux $controleurJeux;
    private ControleurUtilisateur $controleurUtilisateur;
    private ControleurErreur $controleurErreur;

    public function __construct(
        ControleurAccueil $controleurAccueil,
        ControleurJeux $controleurJeux,
        ControleurUtilisateur $controleurUtilisateur,
        ControleurErreur $controleurErreur
    ) {
        $this->controleurAccueil = $controleurAccueil;
        $this->controleurJeux = $controleurJeux;
        $this->controleurUtilisateur = $controleurUtilisateur;
        $this->controleurErreur = $controleurErreur;
    }

    public function router(string $action, string $methode): void
    {
        $action = $this->extraireAction() ?? $action;

        switch ($action) {
            case 'accueil':
                if ($methode === 'GET') {
                    $this->controleurAccueil->index();
                } else {
                    $this->controleurErreur->page405();
                }
                break;

            case 'jeux':
                if ($methode === 'GET') {
                    $this->controleurJeux->index();
                } else {
                    $this->controleurErreur->page405();
                }
                break;

            case 'connexion':
                if ($methode === 'GET') {
                    $this->controleurUtilisateur->connexion();
                } else {
                    $this->controleurErreur->page405();
                }
                break;

            case 'authentifier':
                if ($methode === 'POST') {
                    $this->controleurUtilisateur->authentifier($_POST);
                } else {
                    $this->controleurErreur->page405();
                }
                break;

            case 'deconnexion':
                if ($methode === 'POST') {
                    $this->controleurUtilisateur->deconnecter($_POST);
                } else {
                    $this->controleurErreur->page405();
                }
                break;

            case 'ajouter':
                if ($methode === 'GET') {
                    $this->controleurJeux->afficherFormulaire();
                } elseif ($methode === 'POST') {
                    $this->controleurJeux->ajouter($_POST);
                } else {
                    $this->controleurErreur->page405();
                }
                break;

            case 'modifier':
                $id = $this->extraireId();
                if ($id === null) {
                    $this->controleurErreur->page404();
                    break;
                }

                if ($methode === 'GET') {
                    $this->controleurJeux->afficherModification($id);
                } elseif ($methode === 'POST') {
                    $this->controleurJeux->modifier($id, $_POST);
                } else {
                    $this->controleurErreur->page405();
                }
                break;

            case 'supprimer':
                $id = $this->extraireId();
                if ($id === null) {
                    $this->controleurErreur->page404();
                    break;
                }

                if ($methode === 'GET') {
                    $this->controleurJeux->confirmerSuppression($id);
                } elseif ($methode === 'POST') {
                    $this->controleurJeux->supprimer($id, $_POST);
                } else {
                    $this->controleurErreur->page405();
                }
                break;

            default:
                $this->controleurErreur->page404();
                break;
        }
    }

    private function extraireAction(): ?string
    {
        if (isset($_GET['action']) && is_string($_GET['action']) && $_GET['action'] !== '') {
            return $_GET['action'];
        }

        $chemin = $this->extraireCheminDepuisRequete();

        if ($chemin === '') {
            return null;
        }

        $segments = explode('/', $chemin);

        return $segments[0] !== '' ? $segments[0] : null;
    }

    private function extraireId(): ?int
    {
        if (isset($_GET['id']) && ctype_digit((string) $_GET['id'])) {
            return (int) $_GET['id'];
        }

        $chemin = $this->extraireCheminDepuisRequete();

        if ($chemin === '') {
            return null;
        }

        $segments = explode('/', $chemin);

        if (count($segments) < 2 || !ctype_digit((string) $segments[1])) {
            return null;
        }

        return (int) $segments[1];
    }

    private function extraireCheminDepuisRequete(): string
    {
        $uri = $_SERVER['REQUEST_URI'] ?? $_SERVER['PHP_SELF'] ?? '';
        $uri = parse_url($uri, PHP_URL_PATH) ?: $uri;
        $uri = trim($uri, '/');

        $base = dirname($_SERVER['SCRIPT_NAME'] ?? '/');
        $base = trim($base, '/');

        if ($base !== '' && $uri !== '' && str_starts_with($uri, $base)) {
            $uri = substr($uri, strlen($base));
        }

        return trim($uri, '/');
    }
}