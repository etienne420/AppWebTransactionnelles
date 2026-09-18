# Bibliothèque de jeux de société

Application Web transactionnelle développée en PHP avec une architecture MVC.
L'application permet de consulter, ajouter et supprimer des jeux de société.

## Prérequis

* PHP
* MySQL
* Apache

## Installation

1. Placer le projet dans le dossier du serveur Apache.
2. Créer la base de données MySQL.
3. Exécuter `database/schema.sql`.
4. Configurer les informations de connexion à la base de données.
5. Démarrer Apache et MySQL.
6. Ouvrir l'application avec `index.php`.

## Routage

Toutes les actions passent par `index.php`.

Exemples :

```text
index.php?action=accueil
index.php?action=jeux
index.php?action=form-jeu
index.php?action=ajouter-jeu
index.php?action=supprimer-jeu
```

Les contrôleurs, modèles et vues ne sont pas appelés directement depuis le navigateur.

## Fonctionnalités

* Afficher la liste des jeux
* Consulter les informations d'un jeu
* Ajouter un jeu
* Supprimer un jeu avec confirmation
* Afficher les données liées à un jeu
* Valider les données des formulaires
* Protéger les opérations d'écriture avec un jeton CSRF
* Gérer les erreurs HTTP

## Sécurité et validation

* Les requêtes SQL utilisent des requêtes préparées.
* Les données affichées sont protégées avec `htmlspecialchars()`.
* Les formulaires utilisent un jeton CSRF.
* Les données reçues par `GET` et `POST` sont validées côté serveur.
* Les identifiants sont validés avant leur utilisation.
* Les opérations de modification utilisent uniquement `POST`.
* Une requête `GET` sur une opération de modification retourne une erreur `405`.
* Un jeton CSRF invalide ou absent retourne une erreur `403`.

## Gestion des erreurs

L'application utilise les codes HTTP suivants :

* `400` : données ou identifiant invalide
* `403` : requête refusée ou CSRF invalide
* `404` : action ou page inexistante
* `405` : méthode HTTP non permise
* `500` : erreur interne

Les pages d'erreur ne montrent pas les informations techniques sensibles de l'application.

## Débogage

Xdebug est configuré avec Visual Studio Code.

Le point d'arrêt principal peut être placé dans `index.php` afin d'observer :

* `$_GET`
* `$_POST`
* le routage
* le contrôleur appelé
* les données transmises au modèle

Le débogage utilise le port `9003`.

## Tests manuels

Les fonctionnalités suivantes ont été vérifiées :

* Afficher la liste des jeux
* Accéder au détail d'un jeu
* Utiliser un identifiant invalide
* Ajouter un jeu valide
* Vérifier les champs obligatoires
* Vérifier la longueur des champs
* Conserver les valeurs valides lorsqu'un formulaire contient une erreur
* Tester une valeur contenant du SQL
* Vérifier le jeton CSRF
* Vérifier qu'une requête GET ne peut pas effectuer une modification
* Vérifier la confirmation avant une suppression
* Vérifier qu'un rafraîchissement après une création ne répète pas l'ajout
* Vérifier qu'une action inexistante retourne `404`

## Récits réalisés

Les récits réalisés sont adaptés au domaine de la bibliothèque de jeux de société.

* **Ajouter un jeu** — **Complété**
* **Consulter le détail d'un jeu** — **Complété**

Un récit est indiqué comme **Complété** seulement lorsque tous ses critères d'acceptation sont respectés.

## Base de données

Le fichier `database/schema.sql` contient la structure de la base de données ainsi que les tables utilisées par l'application.

Les relations entre les ressources utilisent des clés primaires et étrangères.

## Git

Le développement du chapitre 3 a été réalisé sur une branche à partir de `main`.

Une fois le travail terminé :

* les changements sont fusionnés dans `main`;
* une version du chapitre est identifiée avec le tag :

```text
projet-chapitre-03
```