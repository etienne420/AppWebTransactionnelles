# Bibliothèque de jeux de société

## 1. Description

Application Web permettant de gérer une bibliothèque de jeux de société. Elle permet notamment de consulter, ajouter, modifier et supprimer des jeux.

## 2. Prérequis

* AMPPS
* Apache
* PHP
* MySQL
* MySQL Workbench
* Git

## 3. Installation

1. Cloner le dépôt dans le dossier `www` d'AMPPS.
2. Démarrer **Apache** et **MySQL** dans AMPPS.
3. Créer la base de données dans MySQL.
4. Exécuter le script SQL du projet pour créer les tables.

## 4. Démarrage

Configurer un alias Apache vers le dossier du projet, puis redémarrer Apache.

L'application est accessible à :

```text
http://localhost/projet/
```

## 5. Construction

Aucune compilation nécessaire.

## 6. Tests

Aucun test automatisé pour cette version.

## 7. Configuration

La connexion à MySQL doit être configurée localement avec :

```text
Hôte : localhost
Base de données : <nom de la base>
Utilisateur : <utilisateur>
Mot de passe : <mot de passe local>
```

Aucun mot de passe, jeton ou chemin personnel ne doit être enregistré dans le dépôt.