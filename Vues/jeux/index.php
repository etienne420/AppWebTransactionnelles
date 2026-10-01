<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des jeux</title>
</head>
<body>
    <h1>Liste des jeux</h1>

    <p><a href="index.php?action=ajouter">Ajouter un jeu</a></p>

    <table border="1">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Année de sortie</th>
                <th>Genre</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jeux as $jeu): ?>
                <tr>
                    <td><?= $this->echapper($jeu['titre']) ?></td>
                    <td><?= $this->echapper((string) $jeu['annee_sortie']) ?></td>
                    <td><?= $this->echapper($jeu['genre']) ?></td>
                    <td>
                        <a href="index.php?action=modifier&id=<?= (int) $jeu['id_jeu'] ?>">Modifier</a>
                        |
                        <a href="index.php?action=supprimer&id=<?= (int) $jeu['id_jeu'] ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>