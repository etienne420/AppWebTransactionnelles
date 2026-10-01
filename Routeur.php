<?php

declare(strict_types=1);

class Routeur
{
    private ControleurJeux $controleurJeux;
    private ControleurErreur $controleurErreur;

    public function __construct(ControleurJeux $controleurJeux, ControleurErreur $controleurErreur)
    {
        $this->controleurJeux = $controleurJeux;
        $this->controleurErreur = $controleurErreur;
    }

    public function router(string $action, string $methode): void
    {
      
    }

    private function extraireId(): ?int
    {
        if (!isset($_GET['id']) || !ctype_digit((string) $_GET['id'])) {
            return null;
        }

        return (int) $_GET['id'];
    }
}