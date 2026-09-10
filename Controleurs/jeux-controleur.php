<?php

require_once __DIR__ . '/../config/bd.php';
require_once __DIR__ . '/../Modeles/jeu-modele.php';

$jeux = getJeux($pdo);

require_once __DIR__ . '/../Vues/jeux/index.php';