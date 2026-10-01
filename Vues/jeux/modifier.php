<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un jeu</title>
</head>
<body>
    <h1>Modifier un jeu</h1>

    <form method="POST" action="index.php?action=modifier&id=<?= (int) $jeu['id_jeu'] ?>">
        <label for="titre">Titre :</label>
        <input type="text" id="titre" name="titre" value="<?= $this->echapper($jeu['titre']) ?>" required>
        <br>

        <label for="annee_sortie">Année de sortie :</label>
        <input type="number" id="annee_sortie" name="annee_sortie" value="<?= $this->echapper((string) $jeu['annee_sortie']) ?>" required>
        <br>

        <label for="genre">Genre :</label>
        <input type="text" id="genre" name="genre" value="<?= $this->echapper($jeu['genre']) ?>" required>
        <br>

        <button type="submit">Modifier</button>
    </form>

    <p><a href="index.php?action=jeux">Retour à la liste</a></p>
</body>
</html>