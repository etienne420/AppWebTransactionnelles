<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer un jeu</title>
</head>
<body>
    <h1>Confirmer la suppression</h1>

    <p>Voulez-vous vraiment supprimer le jeu « <?= $this->echapper($jeu['titre']) ?> » (<?= $this->echapper((string) $jeu['annee_sortie']) ?>) ?</p>

    <form method="POST" action="/projet/supprimer/<?= (int) $jeu['id_jeu'] ?>">
        <input type="hidden" name="jeton_csrf" value="<?= htmlspecialchars(jetonCsrf(), ENT_QUOTES, 'UTF-8') ?>">
        <button type="submit">Confirmer la suppression</button>
    </form>

    <p><a href="/projet/jeux">Annuler et retourner à la liste</a></p>
</body>
</html>