<?php

declare(strict_types=1);

class Routeur
{
    private ControleurAccueil $controleurAccueil;
    private ControleurJeux $controleurJeux;
    private ControleurErreur $controleurErreur;

    public function __construct(
        ControleurAccueil $controleurAccueil,
        ControleurJeux $controleurJeux,
        ControleurErreur $controleurErreur
    ) {
        $this->controleurAccueil = $controleurAccueil;
        $this->controleurJeux = $controleurJeux;
        $this->controleurErreur = $controleurErreur;
    }

    public function router(string $action, string $methode): void
    {
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

    private function extraireId(): ?int
    {
        if (!isset($_GET['id']) || !ctype_digit((string) $_GET['id'])) {
            return null;
        }

        return (int) $_GET['id'];
    }
}