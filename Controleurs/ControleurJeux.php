<?php

declare(strict_types=1);

require_once __DIR__ . '/../Modeles/Jeu.php';
require_once __DIR__ . '/../Vues/Vue.php';
require_once __DIR__ . '/ControleurErreur.php';

class ControleurJeux
{
    private Jeu $jeux;
    private Vue $vue;
    private ControleurErreur $erreurs;

    public function __construct(Jeu $jeux, Vue $vue, ControleurErreur $erreurs)
    {
        $this->jeux = $jeux;
        $this->vue = $vue;
        $this->erreurs = $erreurs;
    }

    public function index(): void
    {
        $listeJeux = $this->jeux->lister();

        $this->vue->afficher(__DIR__ . '/../Vues/jeux/index.php', [
            'jeux' => $listeJeux,
        ]);
    }

    public function afficherFormulaire(): void
    {
        $this->vue->afficher(__DIR__ . '/../Vues/jeux/ajouter.php');
    }

    public function ajouter(array $donnees): void
    {
        $titre = trim((string) ($donnees['titre'] ?? ''));
        $annee_sortie = (int) ($donnees['annee_sortie'] ?? 0);
        $genre = trim((string) ($donnees['genre'] ?? ''));

        if ($titre === '' || $genre === '' || $annee_sortie <= 0) {
            $this->erreurs->page405();
            return;
        }

        $this->jeux->ajouter($titre, $annee_sortie, $genre);

        header('Location: index.php?action=jeux');
        exit;
    }

    public function afficherModification(int $id): void
    {
        $jeu = $this->trouverJeuOu404($id);

        if ($jeu === null) {
            return;
        }

        $this->vue->afficher(__DIR__ . '/../Vues/jeux/modifier.php', [
            'jeu' => $jeu,
        ]);
    }

    private function trouverJeuOu404(int $id): ?array
    {
        $jeu = $this->jeux->trouver($id);

        if ($jeu === null) {
            $this->erreurs->page404();
            return null;
        }

        return $jeu;
    }
}