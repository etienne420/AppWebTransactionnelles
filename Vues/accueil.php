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
        <a href="index.php?action=recits">Récits</a>
        <a href="index.php?action=jeux">Jeux</a>
    </nav>
</body>
</html>