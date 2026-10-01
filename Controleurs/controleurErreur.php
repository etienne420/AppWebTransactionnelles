<?php

declare(strict_types=1);

class ControleurErreur
{
    private Vue $vue;

    public function __construct(Vue $vue)
    {
        $this->vue = $vue;
    }

    public function page404(): void
    {
        http_response_code(404);
        $this->afficherErreur('Page introuvable.', 404);
    }

    public function page400(): void
    {
        http_response_code(400);
        $this->afficherErreur('Données invalides.', 400);
    }

    public function page405(): void
    {
        http_response_code(405);
        $this->afficherErreur('Méthode HTTP non autorisée.', 405);
    }

    public function page403(): void
    {
        http_response_code(403);
        $this->afficherErreur('Accès interdit.', 403);
    }
    public function page500(): void
    {
        http_response_code(500);
        $this->afficherErreur('Erreur serveur.', 500);
    }

    private function afficherErreur(string $message, int $code): void
    {
        $this->vue->afficher(__DIR__ . '/../Vues/erreur.php', [
            'message' => $message,
            'code' => $code,
        ]);
    }
}