
<head>
    <meta charset="UTF-8">
    <title>Ajouter un jeu - Biblio de jeux</title>
    <link rel="stylesheet" href="css/style.css">
</head>



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

        <input type="hidden" name="jeton_csrf"
           value="<?= htmlspecialchars(jetonCsrf(), ENT_QUOTES, 'UTF-8') ?>">

        <button type="submit">Ajouter le jeu</button>
    </form>

<p>
    <a href="index.php?action=accueil">Retour à l'accueil</a>
</p>