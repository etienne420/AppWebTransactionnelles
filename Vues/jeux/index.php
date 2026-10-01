<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des jeux</title>
    <?php $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/'; ?>
    <base href="<?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8') ?>">
</head>
<body>
    <h1>Liste des jeux</h1>

<p><a href="ajouter">Ajouter un jeu</a></p>

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
                    <a href="modifier/<?= (int) $jeu['id_jeu'] ?>">Modifier</a>
                    |
                    <a href="supprimer/<?= (int) $jeu['id_jeu'] ?>">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<p><a href="accueil">Retour à l'accueil</a></p>
</body>
</html>