<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer un jeu</title>
</head>
<body>
    <h1>Confirmer la suppression</h1>

    <p>Voulez-vous vraiment supprimer le jeu « <?= $this->echapper($jeu['titre']) ?> » (<?= $this->echapper((string) $jeu['annee_sortie']) ?>) ?</p>

    <form method="POST" action="index.php?action=supprimer&id=<?= (int) $jeu['id_jeu'] ?>">
        <button type="submit">Confirmer la suppression</button>
    </form>

    <p><a href="index.php?action=jeux">Annuler et retourner à la liste</a></p>
</body>
</html>