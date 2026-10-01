<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un jeu</title>
</head>
<body>
    <h1>Ajouter un jeu</h1>

    <form method="POST" action="index.php?action=ajouter">
        <label for="titre">Titre :</label>
        <input type="text" id="titre" name="titre" required>
        <br>

        <label for="annee_sortie">Année de sortie :</label>
        <input type="number" id="annee_sortie" name="annee_sortie" required>
        <br>

        <label for="genre">Genre :</label>
        <input type="text" id="genre" name="genre" required>
        <br>

        <input type="hidden" name="jeton_csrf" value="<?= htmlspecialchars(jetonCsrf(), ENT_QUOTES, 'UTF-8') ?>">

        <button type="submit">Ajouter</button>
    </form>

    <p><a href="index.php?action=jeux">Retour à la liste</a></p>
</body>
</html>