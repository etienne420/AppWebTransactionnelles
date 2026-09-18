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

    <input type="hidden" name="jeton_csrf"
        value="<?= htmlspecialchars(jetonCsrf(), ENT_QUOTES, 'UTF-8') ?>">

    <button type="submit">Supprimer</button>
</form>

            <hr>

        </div>

    <?php endforeach; ?>

    <br>
    <a href="index.php?action=form-jeu">
        <button type="button">Ajouter un jeu</button>
    </a>


    <p>
        <a href="index.php?action=accueil">Retour à l'accueil</a>
    </p>

</body>

</html>