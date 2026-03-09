# Mini-Projet : Site de la Pizzeria "Bella Napoli"

## Objectif

Réaliser un petit site web pour une pizzeria fictive en **HTML**, **CSS** et **PHP**.
Ce projet vous permettra de mettre en pratique les notions de base vues en cours.


## Description

La pizzeria **Bella Napoli** souhaite un site vitrine simple permettant à ses clients de consulter la carte et de passer une commande en ligne.

Le site comportera **4 pages** :

| Page | Fichier | Description |
|------|---------|-------------|
| Accueil | `index.php` | Présentation de la pizzeria (nom, photo, horaires, adresse) |
| La Carte | `carte.php` | Liste des pizzas avec nom, ingrédients et prix |
| Commander | `commande.php` | Formulaire de commande |
| Confirmation | `confirmation.php` | Récapitulatif de la commande soumise |


## Consignes détaillées

### 1. Accueil (`index.php`)

- Un titre avec le nom de la pizzeria
- Un court texte de présentation (2-3 phrases inventées)
- Les horaires d'ouverture (inventés)
- Une adresse fictive

### 2. La Carte (`carte.php`)

Créez un **tableau PHP** (array) contenant au moins **6 pizzas**. Chaque pizza possède :

- un nom
- une liste d'ingrédients
- un prix

Affichez ces pizzas sur la page en parcourant le tableau avec une **boucle `foreach`**.

Chaque pizza doit être présentée dans une "carte" (card) stylisée en CSS.

### 3. Commander (`commande.php`)

Un formulaire HTML (méthode **POST**) contenant :

- Nom du client (champ texte, **obligatoire**)
- Adresse de livraison (champ texte, **obligatoire**)
- Pizza choisie (liste déroulante `<select>` générée dynamiquement depuis le même tableau PHP que la carte)
- Quantité (champ numérique, min 1, max 10)
- Un bouton "Commander"

### 4. Confirmation (`confirmation.php`)

Cette page :

- Récupère les données envoyées par le formulaire (`$_POST`)
- Vérifie que les champs obligatoires sont remplis
  - Si un champ est vide : afficher un message d'erreur et un lien pour revenir au formulaire
  - Si tout est rempli : afficher un récapitulatif de la commande avec le **prix total** (prix unitaire x quantité)


## Contraintes techniques

### HTML

- Utiliser des balises sémantiques (`<header>`, `<nav>`, `<main>`, `<footer>`)
- Le formulaire doit utiliser les attributs de validation HTML (`required`, `min`, `max`)

### CSS

- **Un seul fichier** `style.css` partagé par toutes les pages
- Mise en page soignée et lisible (pas besoin que ce soit spectaculaire)
- La navigation doit être présente sur toutes les pages
- Le site doit être présentable (marges, couleurs, typographie)

### PHP

- Le tableau des pizzas doit être défini dans un **fichier séparé** `pizzas.php` et inclus avec `include` ou `require` dans les pages qui en ont besoin
- La navigation (header/menu) doit être dans un fichier séparé `header.php` inclus sur chaque page
- Le footer doit également être dans un fichier séparé `footer.php`
- Utiliser `htmlspecialchars()` pour afficher les données saisies par l'utilisateur