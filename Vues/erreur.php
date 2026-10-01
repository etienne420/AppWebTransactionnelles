<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Erreur <?= $this->echapper((string) $code) ?></title>
</head>
<body>
    <h1>Erreur <?= $this->echapper((string) $code) ?></h1>
    <p><?= $this->echapper($message) ?></p>
    <p><a href="index.php?action=jeux">Retour à la liste des jeux</a></p>
</body>
</html>