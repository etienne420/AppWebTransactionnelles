<?php

declare(strict_types=1);

require_once __DIR__ . '/Modele.php';

class Utilisateur extends Modele
{
    public function trouverParIdentifiant(string $identifiant): ?array
    {
        if ($this->tableExiste('utilisateurs')) {
            $utilisateur = $this->executer(
                'SELECT id, nom, identifiant, mot_de_passe
                 FROM utilisateurs
                 WHERE identifiant = :identifiant',
                ['identifiant' => $identifiant]
            )->fetch();

            if ($utilisateur) {
                return $utilisateur;
            }
        }

        if (!$this->tableExiste('utilisateur')) {
            return null;
        }

        $utilisateur = $this->executer(
            'SELECT id_utilisateur AS id, nom, courriel AS identifiant,
                    mot_de_passe, 1 AS ancien_format
             FROM utilisateur
             WHERE courriel = :identifiant',
            ['identifiant' => $identifiant]
        )->fetch();

        return $utilisateur ?: null;
    }

    public function verifierMotDePasse(array $utilisateur, string $motDePasse): bool
    {
        $motDePasseStocke = (string) $utilisateur['mot_de_passe'];

        return password_verify($motDePasse, $motDePasseStocke)
            || ((bool) $utilisateur['ancien_format']
                && hash_equals($motDePasseStocke, $motDePasse));
    }

    private function tableExiste(string $nom): bool
    {
        $requete = $this->pdo->query('SHOW TABLES LIKE ' . $this->pdo->quote($nom));

        return $requete->fetchColumn() !== false;
    }
}
