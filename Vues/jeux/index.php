<h1>Liste des jeux</h1>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Jeux - Biblio de jeux</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php foreach ($jeux as $jeu): ?>

        <div>
            <p>
                ID : <?= htmlspecialchars($jeu['id_jeu'], ENT_QUOTES, 'UTF-8') ?>
            </p>

            <p>
                Nom du jeu : <?= htmlspecialchars($jeu['titre'], ENT_QUOTES, 'UTF-8') ?>
            </p>

            <p>
                Date de sortie : <?= htmlspecialchars($jeu['annee_sortie'], ENT_QUOTES, 'UTF-8') ?>
            </p>

            <p>
                Genre : <?= htmlspecialchars($jeu['genre'], ENT_QUOTES, 'UTF-8') ?>
            </p>

            <form action="index.php?action=supprimer-jeu" method="post">
                <input type="hidden" name="id_jeu" value="<?= (int) $jeu['id_jeu'] ?>">
                <button type="submit">Supprimer</button>
            </form>

            <hr>

        </div>

    <?php endforeach; ?>

    <h1>Ajouter un jeu</h1>

    <form action="index.php?action=ajouter-jeu" method="post">
        <p>
            <label for="titre">Nom du jeu :</label>
            <input type="text" name="titre" id="titre" required>
        </p>

        <p>
            <label for="annee_sortie">Date de sortie :</label>
            <input type="number" name="annee_sortie" id="annee_sortie" required>
        </p>

        <p>
            <label for="genre">Genre :</label>
            <input type="text" name="genre" id="genre" required>
        </p>

        <button type="submit">Ajouter le jeu</button>
    </form>

    <p>
        <a href="index.php?action=accueil">Retour à l'accueil</a>
    </p>

</body>

</html>