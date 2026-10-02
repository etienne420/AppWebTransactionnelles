CREATE DATABASE IF NOT EXISTS projet_db
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE projet_db;

CREATE TABLE IF NOT EXISTS jeu (
    id_jeu INT UNSIGNED NOT NULL AUTO_INCREMENT,
    titre VARCHAR(150) NOT NULL,
    annee_sortie SMALLINT UNSIGNED NOT NULL,
    genre VARCHAR(100) NOT NULL,
    PRIMARY KEY (id_jeu)
) ENGINE=InnoDB
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS utilisateurs (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        nom VARCHAR(100) NOT NULL,
        identifiant VARCHAR(150) NOT NULL,
        mot_de_passe VARCHAR(255) NOT NULL,
        PRIMARY KEY (id),
        UNIQUE KEY uq_utilisateurs_identifiant (identifiant)
) ENGINE=InnoDB
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;