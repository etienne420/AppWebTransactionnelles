<?php

declare(strict_types=1);

class ControleurUtilisateur
{
    private $utilisateurs;
    private $authentification;
    private $vue;
    private ControleurErreur $erreurs;

    public function __construct(
        Utilisateur $utilisateurs,
        Authentification $authentification,
        Vue $vue,
        ControleurErreur $erreurs
    ) {
        $this->utilisateurs = $utilisateurs;
        $this->authentification = $authentification;
        $this->vue = $vue;
        $this->erreurs = $erreurs;
    }

    public function connexion(?string $erreur = null, string $identifiant = ''): void
    {
        $this->vue->afficher(__DIR__ . '/../Vues/utilisateurs/connexion.php', compact('erreur', 'identifiant'));
    }

    public function authentifier(array $donnees): void
    {
        if (!$this->verifierJetonCsrf($donnees)) {
            return;
        }

        $identifiant = trim((string) ($donnees['identifiant'] ?? ''));
        $motDePasse = (string) ($donnees['mot_de_passe'] ?? '');
        $utilisateur = $identifiant === '' || $motDePasse === ''
            ? null
            : $this->utilisateurs->trouverParIdentifiant($identifiant);

        if ($utilisateur === null
            || !$this->utilisateurs->verifierMotDePasse($utilisateur, $motDePasse)) {
            $this->connexion('Identifiant ou mot de passe invalide.', $identifiant);
            return;
        }

        $this->authentification->connecter($utilisateur);
        header('Location: /projet/accueil');
        exit;
    }

    public function deconnecter(array $donnees): void
    {
        if (!$this->verifierJetonCsrf($donnees)) {
            return;
        }

        $this->authentification->deconnecter();
        header('Location: /projet/accueil');
        exit;
    }

    private function verifierJetonCsrf(array $donnees): bool
    {
        if (!verifierJetonCsrf($donnees['jeton_csrf'] ?? null)) {
            $this->erreurs->page403();
            return false;
        }

        return true;
    }
}
