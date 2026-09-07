<?php

require_once __DIR__ . '/config/bd.php';

$requete = $pdo->query("SELECT * FROM utilisateur");
$utilisateurs = $requete->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Liste des utilisateurs</h1>

<?php foreach ($utilisateurs as $utilisateur): ?>

    <div>
        <p>
            ID : <?= htmlspecialchars($utilisateur['id_utilisateur'], ENT_QUOTES, 'UTF-8') ?>
        </p>

        <p>
            Nom : <?= htmlspecialchars($utilisateur['nom'], ENT_QUOTES, 'UTF-8') ?>
        </p>

        <p>
            Courriel : <?= htmlspecialchars($utilisateur['courriel'], ENT_QUOTES, 'UTF-8') ?>
        </p>

        <p>
            Rôle : <?= htmlspecialchars($utilisateur['role'], ENT_QUOTES, 'UTF-8') ?>
        </p>

        <hr>
    </div>

<?php endforeach; ?>