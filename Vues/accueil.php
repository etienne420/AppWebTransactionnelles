<?php 
$nomProjet = 'Biblio de jeux'; 
$auteur = 'Etienne Desaulniers'; 
$versionPhp = PHP_VERSION; 
$descriptionProjet = 'Une bibliotheque de jeux où des utilisateurs peuvent gérer leur collection de jeux vidéo, donner des évaluations et emprunter des jeux.';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($nomProjet) ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1><?= htmlspecialchars($nomProjet) ?></h1>  

    <p>Auteur : <?= htmlspecialchars($auteur) ?></p>

    <p>Version PHP : <?= htmlspecialchars($versionPhp) ?></p>

    <p>Description du projet : <?= htmlspecialchars($descriptionProjet) ?></p>

    <nav>
        <a href="jeux">Jeux</a>
        <?php if ($utilisateur === null): ?>
            <a href="connexion">Connexion</a>
        <?php else: ?>
            <span>Connecté : <?= htmlspecialchars($utilisateur['nom'], ENT_QUOTES, 'UTF-8') ?></span>
            <form action="deconnexion" method="post">
                <input type="hidden" name="jeton_csrf" value="<?= htmlspecialchars(jetonCsrf(), ENT_QUOTES, 'UTF-8') ?>">
                <button type="submit">Se déconnecter</button>
            </form>
        <?php endif; ?>
    </nav>
</body>
</html>