<?php

declare(strict_types=1);

class Vue
{
    public function afficher(string $cheminVue, array $donnees = []): void
    {
        extract($donnees, EXTR_SKIP);
        require $cheminVue;
    }

    public function echapper(string $valeur): string
    {
        return htmlspecialchars($valeur, ENT_QUOTES, 'UTF-8');
    }
}