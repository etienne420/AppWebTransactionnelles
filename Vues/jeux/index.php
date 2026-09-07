<h1>Liste des jeux</h1>

<?php foreach ($jeux as $jeu): ?>

    <div>
        <p>
            ID : <?= htmlspecialchars($jeu['id_jeu'], ENT_QUOTES, 'UTF-8') ?>
        </p>

        <p>
            Nom du jeu : <?= htmlspecialchars($jeu['titre'], ENT_QUOTES, 'UTF-8') ?>
        </p>

        <p>
            Date de sortie : <?= htmlspecialchars($jeu['annee_sortie'], ENT_QUOTES, 'UTF-8') ?>
        </p>

        <p>
            Genre : <?= htmlspecialchars($jeu['genre'], ENT_QUOTES, 'UTF-8') ?>
        </p>

        <hr>

        
    </div>

<?php endforeach; ?>

    <p>
        <a href="index.php">Retour à l'accueil</a>
    </p>