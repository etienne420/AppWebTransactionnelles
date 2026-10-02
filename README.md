# Bibliothèque de jeux de société

Application Web transactionnelle développée en PHP avec une architecture MVC.
L'application permet de consulter, ajouter, modifier et supprimer des jeux de société.

## Prérequis

* PHP
* MySQL
* Apache

## Installation

1. Placer le projet dans le dossier du serveur Apache.
2. Démarrer Apache et MySQL.
3. Exécuter `database/schema.sql` dans MySQL.
4. Ouvrir `index.php` dans le navigateur.

En développement local, la connexion utilise par défaut `127.0.0.1:3306`, la base `projet_db`, l'utilisateur `root` et aucun mot de passe. Si votre installation MySQL utilise d'autres paramètres, définissez `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME` et `DB_PASSWORD` dans l'environnement Apache. Pour un serveur public, définissez toujours des identifiants dédiés au lieu des valeurs locales par défaut.

## Routage

Toutes les actions passent par `index.php`.

Exemples :

```text
index.php?action=accueil
index.php?action=jeux
index.php?action=connexion
index.php?action=authentifier
index.php?action=deconnexion
index.php?action=ajouter
index.php?action=modifier&id=1
index.php?action=supprimer&id=1
```

Les contrôleurs, modèles et vues ne sont pas appelés directement depuis le navigateur.

## Fonctionnalités

* Afficher la page d'accueil
* Afficher la liste des jeux
* Connecter et déconnecter un utilisateur
* Ajouter un jeu
* Modifier un jeu
* Supprimer un jeu avec confirmation
* Valider les champs obligatoires
* Protéger les opérations d'écriture avec un jeton CSRF
* Gérer les erreurs HTTP

## Sécurité et validation

* Les requêtes SQL utilisent des requêtes préparées.
* Les données affichées sont protégées avec `htmlspecialchars()`.
* Les formulaires utilisent un jeton CSRF.
* Les données reçues par `GET` et `POST` sont validées côté serveur.
* Les identifiants sont validés avant leur utilisation.
* Les opérations d'écriture utilisent `POST`.
* Les requêtes `GET` servent à afficher les pages et formulaires.
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
* Utiliser un identifiant invalide
* Ajouter un jeu valide
* Vérifier les champs obligatoires
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

Le fichier `database/schema.sql` crée la base `projet_db` ainsi que les tables `jeu` et `utilisateurs` utilisées par l'application. Les autres scripts SQL du dépôt sont conservés pour les anciens travaux et ne sont pas requis pour lancer cette version.

La création des comptes se fait directement dans la base. Générer d'abord un hachage avec PHP :

```sh
php -r "echo password_hash('votre-mot-de-passe', PASSWORD_DEFAULT), PHP_EOL;"
```

Puis enregistrer l'identifiant, le nom et le hachage retourné dans `utilisateurs.mot_de_passe`. L'application ne stocke jamais le mot de passe en clair.

## Git

Le développement du chapitre 3 a été réalisé sur une branche à partir de `main`.

Une fois le travail terminé :

* les changements sont fusionnés dans `main`;
* une version du chapitre est identifiée avec le tag :

```text
projet-chapitre-03
```