<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un jeu</title>
</head>
<body>
    <h1>Modifier un jeu</h1>

    <form method="POST" action="/projet/modifier/<?= (int) $jeu['id_jeu'] ?>">
        <label for="titre">Titre :</label>
        <input type="text" id="titre" name="titre" value="<?= $this->echapper($jeu['titre']) ?>" required>
        <br>

        <label for="annee_sortie">Année de sortie :</label>
        <input type="number" id="annee_sortie" name="annee_sortie" value="<?= $this->echapper((string) $jeu['annee_sortie']) ?>" required>
        <br>

        <label for="genre">Genre :</label>
        <input type="text" id="genre" name="genre" value="<?= $this->echapper($jeu['genre']) ?>" required>
        <br>

        <input type="hidden" name="jeton_csrf" value="<?= htmlspecialchars(jetonCsrf(), ENT_QUOTES, 'UTF-8') ?>">

        <button type="submit">Modifier</button>
    </form>

    <p><a href="/projet/jeux">Retour à la liste</a></p>
</body>
</html>