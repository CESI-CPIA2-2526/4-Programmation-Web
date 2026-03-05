---
marp: true
theme: default
paginate: true
footer: 'Bloc 4 - Programmation Web | Rohan Fossé'
style: |
  /* ===== POLICE ET TAILLE ===== */
  section {
    font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    font-size: 26px;
    padding: 40px;
  }

  /* ===== TITRES ===== */
  h1 {
    color: #2c3e50;
    border-bottom: 3px solid #3498db;
    padding-bottom: 10px;
    margin-bottom: 30px;
  }

  h2 {
    color: #34495e;
    margin-top: 20px;
  }

  h3 {
    color: #7f8c8d;
  }

  /* ===== TABLEAUX ===== */
  table {
    font-size: 22px;
    width: 100%;
    border-collapse: collapse;
  }

  th {
    background-color: #3498db;
    color: white;
    padding: 12px;
  }

  td {
    padding: 10px;
    border-bottom: 1px solid #ecf0f1;
  }

  tr:nth-child(even) {
    background-color: #f8f9fa;
  }

  /* ===== CODE ===== */
  code {
    background-color: #f4f4f4;
    padding: 2px 6px;
    border-radius: 3px;
    font-size: 22px;
  }

  pre {
    background-color: #f0f4f8;
    border: 1px solid #d0dae6;
    padding: 20px;
    border-radius: 8px;
    font-size: 18px;
  }

  pre code {
    background-color: transparent;
    color: #1a2e45;
  }

  /* ===== LISTES ===== */
  ul, ol {
    margin-left: 20px;
  }

  li {
    margin-bottom: 8px;
  }

  /* ===== FOOTER ===== */
  footer {
    font-size: 14px;
    color: #95a5a6;
  }

  /* ===== SLIDE DE TITRE ===== */
  section.title {
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  section.title h1 {
    border-bottom: none;
    font-size: 48px;
  }

  /* ===== MISE EN EVIDENCE ===== */
  strong {
    color: #2980b9;
  }

  blockquote {
    border-left: 4px solid #3498db;
    padding-left: 20px;
    margin-left: 0;
    color: #555;
    font-style: italic;
  }

  /* ===== DEUX COLONNES ===== */
  .columns {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
  }
---

<!-- _class: title -->

# Architecture MVC

## Model - View - Controller en PHP

---

# Le problème : tout dans un fichier

```php
<?php
// index.php - 300 lignes de mélange

$utilisateurs = [['nom' => 'Alice', 'age' => 22], ...];

// Logique métier
$total = 0;
foreach ($utilisateurs as $u) { $total += $u['age']; }
$moyenne = $total / count($utilisateurs);

// Affichage HTML mélangé avec le PHP
echo "<h1>Liste des inscrits</h1>";
foreach ($utilisateurs as $u) {
    echo "<p>" . $u['nom'] . "</p>";
}
echo "<p>Âge moyen : $moyenne ans</p>";
?>
```

> Un seul fichier fait tout : stocker les données, les traiter ET les afficher.

---

# Les conséquences du code "spaghetti"

- **Impossible à maintenir** : changer l'affichage oblige à toucher la logique
- **Impossible à tester** : tout est lié, rien n'est isolé
- **Collaboration difficile** : le dev back et le dev front se marchent dessus
- **Pas de réutilisation** : dupliquer du code entre les pages

**La solution : séparer les responsabilités.**

---

# Les trois composants

| Composant | Rôle | Ce qu'il contient |
|-----------|------|-------------------|
| **Model** | Les données et la logique métier | Tableaux, classes, fonctions de calcul, accès base de données |
| **View** | L'affichage | HTML + PHP minimal pour afficher des variables |
| **Controller** | L'orchestration | Reçoit la requête, appelle le Model, choisit la View |

**Règle d'or :** chaque composant a une seule responsabilité.

---

# Le Model

**Définition :** Le Model représente les **données** et la **logique métier** de l'application.

Ce qu'il fait :

- Contient les données (tableaux, classes, base de données)
- Contient les fonctions de traitement (calculs, validations, filtres)
- Retourne des résultats - il ne fait **jamais** de `echo`

Ce qu'il ne fait PAS :

- Pas de HTML
- Pas d'accès direct aux superglobales `$_GET`, `$_POST`
- Pas de logique de navigation

> Le Model est indépendant : on peut le tester sans navigateur.

---

# Le Model - exemple PHP

<div class="columns">
<div>

`models/OffreModel.php`

```php
<?php
class OffreModel {
  private array $offres = [
    ['titre' => 'Dev PHP',
     'ouvert' => true],
    ['titre' => 'DevOps',
     'ouvert' => false],
  ];
  // Retourne toutes les offres
  public function getAll(): array {
    return $this->offres;  // retourne !
  }

  // Logique métier : compter les ouvertes
  public function compterOuvertes(): int {
    $n = 0;
    foreach ($this->offres as $o) {
      if ($o['ouvert']) $n++;
    }
    return $n;  // retourne !
  }
}
```

</div>
<div>

Le Model **retourne** - il n'affiche jamais :

- Contient les données
- Contient la logique métier
- Ses méthodes **retournent** des valeurs

Ce qui est **interdit** dans un Model :

```php
// Pas de HTML, pas d'affichage
echo "<li>Dev PHP</li>";

// Pas d'affichage direct
echo $this->offres[0]['titre'];

// Pas d'accès aux superglobales
$titre = $_POST['titre'];
```

> Testable sans navigateur.

</div>
</div>

---

# La View

**Définition :** La View est responsable uniquement de l'**affichage**.

Ce qu'elle fait :

- Reçoit des variables préparées par le Controller
- Génère le HTML en les affichant
- Peut contenir du PHP minimal (`foreach`, `if`, `echo`)

Ce qu'elle ne fait PAS :

- Pas de calculs métier
- Pas d'appel direct au Model
- Pas d'accès à `$_POST`, `$_GET`

> La View est "bête" par design : si elle reçoit des données correctes, elle les affiche. C'est tout.

---

# La View - exemple PHP

<div class="columns">
<div>

`views/offres.php`

```php
<!-- Variables reçues : $offres, $nbOuvertes -->

<h1>Offres (<?= $nbOuvertes ?> ouvertes)</h1>

<ul>
<?php foreach ($offres as $offre): ?>
  <li>
    <?= htmlspecialchars($offre['titre']) ?>
    - <?= htmlspecialchars($offre['ville']) ?>
    (<?= $offre['ouvert'] ? 'ouverte' : 'fermee' ?>)
  </li>
<?php endforeach; ?>
</ul>
```

</div>
<div>

La View reçoit des variables du Controller.
Elle **ne sait pas** d'où elles viennent.

Ce qui est **interdit** dans une View :

```php
// Pas d'instanciation de Model
$model = new OffreModel();

// Pas de logique métier
$total = 0;
foreach ($offres as $o) {
  $total += $o['salaire'];
}

// Pas d'accès aux superglobales
$page = $_GET['page'];
```

</div>
</div>

---

# Le Controller

**Définition :** Le Controller est le **chef d'orchestre**. Il reçoit la requête et coordonne Model et View.

Ce qu'il fait :

- Reçoit et analyse la requête HTTP (`$_GET`, `$_POST`, `$_SERVER`)
- Appelle les fonctions du Model pour récupérer les données
- Prépare les variables à passer à la View
- Inclut la bonne View

Ce qu'il ne fait PAS :

- Pas de HTML ni de `echo`
- Pas de logique métier (calculs, validations complexes)

---

# Le Controller - exemple PHP

<div class="columns">
<div>

`index.php` — le routeur

```php
<?php
// index.php ne fait qu'une chose :
// lire la route et appeler le bon Controller

$vue = $_GET['vue'] ?? 'liste';

match ($vue) {
    'liste'  => require 'controllers/OffreController.php',
    'detail' => require 'controllers/OffreController.php',
    'stats'  => require 'controllers/StatsController.php',
    default  => require 'views/404.php',
};
```

</div>
<div>

`controllers/OffreController.php`

```php
<?php
// Le Controller : orchestre Model et View

require_once 'models/OffreModel.php';
$model = new OffreModel();

// Étape 1 : lire la requête
$afficherTout = isset($_GET['tout']);

// Étape 2 : appeler le Model
$offres     = $afficherTout
                ? $model->getAll()
                : $model->getOuvertes();
$nbOuvertes = $model->compterOuvertes();

// Étape 3 : charger la View
// $offres et $nbOuvertes sont accessibles dans la View
require_once 'views/offres.php';
// Aucun echo ici.
```

</div>
</div>

---

# Le flux d'une requete HTTP

```text
1. L'utilisateur tape une URL dans son navigateur
         │
         ▼
2. index.php reçoit la requête
         │
         ▼
3. Le Controller analyse $_GET / $_POST / $_SERVER
         │
         ▼
4. Le Controller appelle le Model → Le Model retourne les données
         │
         ▼
5. Le Controller passe les données à la View → La View génère le HTML
         │
         ▼
6. Le HTML est renvoyé au navigateur
```

---

# Structure de fichiers

```text
mon-projet/
├── index.php               ← Point d'entrée unique
├── controllers/
│   └── UserController.php
├── models/
│   └── UserModel.php
├── views/
│   ├── liste.php
│   └── profil.php
└── public/
    ├── css/
    └── images/
```

**Convention :** un Controller par fonctionnalité, une View par page affichée.

---

# Le point d'entrée unique

Avec MVC, **toutes les requêtes passent par `index.php`**.

Pour forcer cela avec Apache, on utilise un fichier `.htaccess` :

```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^ index.php [QSA,L]
```

Le Controller lit ensuite l'URL pour savoir quoi afficher :

```php
$page = $_GET['page'] ?? 'liste';

if ($page === 'liste') {
    require_once 'controllers/UserController.php';
} elseif ($page === 'profil') {
    require_once 'controllers/ProfilController.php';
}
```

---

# Gerer GET et POST dans le Controller

```php
<?php
// controllers/InscriptionController.php

require_once 'models/InscritModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $erreurs = validerInscription($_POST);

    if (empty($erreurs)) {
        enregistrerInscrit($_POST);
        $inscrits = getTousLesInscrits();
        require_once 'views/confirmation.php';
    } else {
        require_once 'views/formulaire.php'; // réaffiche avec $erreurs
    }

} else {
    require_once 'views/formulaire.php';
}
```

---

# Les règles de chaque couche

| Couche | Peut faire | Ne peut pas faire |
|--------|-----------|-------------------|
| **Model** | Calculs, validation, retourner des données | `echo`, HTML, lire `$_POST` |
| **View** | Afficher des variables, boucles d'affichage | Calculs métier, appeler le Model |
| **Controller** | Lire `$_GET`/`$_POST`, appeler Model et View | `echo` HTML, logique métier |

> Si vous hésitez sur où mettre du code, posez-vous la question : est-ce de la **donnée/logique**, de l'**affichage**, ou de l'**orchestration** ?

---

# Les classes POO comme Models

Avec la POO, les classes deviennent naturellement les Models.

<div class="columns">
<div>

**Sans POO**

```php
// model - fonctions globales
function getUtilisateurs(): array { ... }
function compterActifs(): int { ... }
```

</div>
<div>

**Avec POO**

```php
// model - classe
class UserModel {
  public function getAll(): array { }
  public function compterActifs(): int { }
  public function toArray(): array { }
}
```

</div>
</div>

La méthode `toArray()` est la **sortie standardisée** du Model vers la View : elle évite que la View connaisse la structure interne de la classe.

---

# Avantages de MVC

| Avantage | Explication |
|----------|-------------|
| **Séparation des responsabilités** | Chaque fichier a un rôle clair |
| **Maintenabilité** | Modifier l'affichage ne touche pas la logique |
| **Travail en équipe** | Back et front peuvent travailler en parallèle |
| **Réutilisabilité** | Un Model peut servir plusieurs Views |
| **Testabilité** | Le Model est testable sans navigateur |
| **Lisibilité** | Un développeur qui arrive sait où chercher quoi |

---

# Pour aller plus loin

<div class="columns">
<div>

**Moteurs de template**

Remplacent les Views PHP brutes par une syntaxe dédiée plus propre.

```twig
{# views/liste.html.twig #}
{% for user in utilisateurs %}
  <p>{{ user.nom }}</p>
{% endfor %}
```

**Twig** est le moteur le plus répandu en PHP.

</div>
<div>

**Composer**

Gestionnaire de dépendances PHP.

```bash
composer require twig/twig
```

Permet d'installer Twig (et toute librairie) et gère l'**autoloading** des classes automatiquement.

```json
{
  "require": {
    "twig/twig": "^3.0"
  }
}
```

</div>
</div>

---

# À retenir

1. **Model** = données + logique - ne fait jamais de `echo`
2. **View** = affichage - ne fait jamais de calcul
3. **Controller** = orchestration - ne fait jamais de HTML
4. **`index.php`** = point d'entrée unique qui distribue les requêtes
5. La View reçoit des **variables**, pas des appels au Model

**La question à toujours se poser :**
> Est-ce de la donnée, de l'affichage ou de l'orchestration ?

---

<!-- _class: title -->

# Questions ?
