<?php
$prenom = 'Amine';
$moment = date('Y-m-d H:i:s');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Premier essai PHP</title>
</head>
<body>
    <h1>Bonjour <?= htmlspecialchars($prenom) ?>!</h1>
    <p>Page générée le <?= $moment ?>.</p>
</body>
</html>