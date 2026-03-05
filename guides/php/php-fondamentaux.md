---
marp: true
theme: default
paginate: true
footer: 'Bloc 4 - Programmation Web'
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

# PHP — Fondamentaux

## Syntaxe, chaînes, POO, sécurité

---

# PHP, c'est quoi ?

PHP est un langage **exécuté côté serveur** : le code PHP est interprété par le serveur, qui renvoie du HTML au navigateur.

```text
Navigateur  ──(requête HTTP)──▶  Serveur Apache
                                      │
                                 PHP interprète
                                 le fichier .php
                                      │
            ◀──(réponse HTML)──  HTML généré
```

- Le navigateur ne voit **jamais** le code PHP
- PHP est intégré directement dans le HTML via les balises `<?php ?>`
- Extension des fichiers : `.php`

---

# Syntaxe de base

```php
<?php
// Commentaire sur une ligne
/* Commentaire
   sur plusieurs lignes */

// Affichage
echo "Bonjour le monde !";
echo "<p>Du HTML depuis PHP</p>";

// Constante
define('VERSION', '1.0');
echo VERSION; // 1.0

// PHP dans du HTML
?>
<h1>Bienvenue</h1>
<p>Version : <?= VERSION ?></p>
```

> `<?= $var ?>` est un raccourci pour `<?php echo $var; ?>`

---

# Variables et types

```php
<?php
$prenom   = "Alice";       // string
$age      = 22;            // int
$moyenne  = 14.75;         // float
$estActif = true;          // bool
$inconnu  = null;          // null
$notes    = [12, 15, 18];  // array
```

| Type | Exemple | `gettype()` |
|------|---------|-------------|
| string | `"Alice"` | `"string"` |
| int | `22` | `"integer"` |
| float | `14.75` | `"double"` |
| bool | `true` | `"boolean"` |
| null | `null` | `"NULL"` |
| array | `[1, 2, 3]` | `"array"` |

PHP est **dynamiquement typé** : le type s'adapte à la valeur assignée.

---

# Structures de contrôle

<div class="columns">
<div>

**Conditions**

```php
$note = 14;

if ($note >= 16) {
    echo "Très bien";
} elseif ($note >= 14) {
    echo "Bien";
} elseif ($note >= 10) {
    echo "Passable";
} else {
    echo "Insuffisant";
}
```

</div>
<div>

**Boucles**

```php
// foreach sur un tableau
$noms = ["Alice", "Bob", "Clara"];
foreach ($noms as $nom) {
    echo "<p>$nom</p>";
}

// foreach avec clé
$scores = ['Alice' => 18, 'Bob' => 14];
foreach ($scores as $nom => $score) {
    echo "$nom : $score";
}

// for classique
for ($i = 1; $i <= 5; $i++) {
    echo $i;
}
```

</div>
</div>

---

# Fonctions

```php
<?php
// Définition avec type hints et valeur par défaut
function calculerTTC(float $ht, float $tva = 20.0): float {
    return $ht * (1 + $tva / 100);
}

// Appels
echo calculerTTC(100);      // 120
echo calculerTTC(100, 5.5); // 105.5

// Fonction avec plusieurs paramètres
function formaterNom(string $prenom, string $nom): string {
    return mb_strtoupper($nom) . " " . ucfirst($prenom);
}

echo formaterNom("alice", "dupont"); // DUPONT Alice
```

> Les **type hints** (`float`, `string`) documentent et sécurisent les appels.
> Le type de retour après `:` indique ce que la fonction retourne.

---

# Les chaînes : guillemets simples vs doubles

<div class="columns">
<div>

**Guillemets simples `'`**

```php
$nom = 'Alice';

// Pas d'interpolation
echo 'Bonjour $nom';
// → Bonjour $nom

// Pas d'échappement sauf \' et \\
echo 'Il dit : \'Bonjour\'';
// → Il dit : 'Bonjour'
```

Utiliser quand la chaîne est **littérale** (pas de variable dedans).

</div>
<div>

**Guillemets doubles `"`**

```php
$nom = "Alice";

// Interpolation de variables
echo "Bonjour $nom !";
// → Bonjour Alice !

// Séquences d'échappement
echo "Ligne 1\nLigne 2";
echo "Tabulation\tic";
```

Utiliser quand la chaîne contient des **variables** ou des **caractères spéciaux**.

</div>
</div>

---

# Heredoc et concaténation

<div class="columns">
<div>

**Heredoc**

```php
$prenom = "Alice";
$age    = 22;

$fiche = <<<EOT
Prénom : $prenom
Âge    : $age ans
EOT;

echo $fiche;
```

Utile pour les blocs de texte **multi-lignes** avec interpolation.

</div>
<div>

**Concaténation avec `.`**

```php
$prenom = 'Alice';
$age    = 22;

// Opérateur .
$phrase = 'Prénom : ' . $prenom
        . ', Âge : ' . $age . ' ans';

// Opérateur .=
$html  = '<ul>';
$html .= '<li>' . $prenom . '</li>';
$html .= '</ul>';
echo $html;
```

</div>
</div>

---

# Fonctions de chaînes essentielles

| Fonction | Rôle | Exemple |
|----------|------|---------|
| `mb_strlen($s)` | Longueur (UTF-8) | `mb_strlen("été")` → `3` |
| `mb_strtoupper($s)` | Majuscules (UTF-8) | `"été"` → `"ÉTÉ"` |
| `mb_strtolower($s)` | Minuscules (UTF-8) | `"ÉTÉ"` → `"été"` |
| `mb_substr($s, $début, $n)` | Sous-chaîne | `mb_substr("Bonjour", 0, 3)` → `"Bon"` |
| `mb_strpos($s, $cherche)` | Position | `mb_strpos("Bonjour", "jour")` → `3` |
| `str_replace($old, $new, $s)` | Remplacement | `str_replace(" ", "-", "le monde")` → `"le-monde"` |
| `trim($s)` | Supprime espaces en bordure | `trim("  hello  ")` → `"hello"` |
| `explode($sep, $s)` | Découpe en tableau | `explode(",", "a,b,c")` → `["a","b","c"]` |
| `implode($sep, $tab)` | Tableau → chaîne | `implode("-", ["a","b"])` → `"a-b"` |

> Toujours préférer les fonctions **`mb_*`** pour les textes en français (UTF-8).

---

# Les superglobales

Variables accessibles depuis n'importe quel fichier PHP, sans `global`.

| Superglobale | Contenu |
|-------------|---------|
| `$_GET` | Paramètres passés dans l'URL (`?page=2`) |
| `$_POST` | Données envoyées par un formulaire POST |
| `$_SERVER` | Informations sur le serveur et la requête |
| `$_SESSION` | Données persistantes entre les pages |
| `$_FILES` | Fichiers téléversés par formulaire |
| `$_COOKIE` | Cookies du navigateur |
| `$_REQUEST` | Fusion de `$_GET`, `$_POST` et `$_COOKIE` |

> Ne jamais afficher directement une superglobale sans l'avoir **échappée** avec `htmlspecialchars()`.

---

# $_GET et $_POST

<div class="columns">
<div>

**$_GET — paramètres URL**

```php
// URL : monsite.php?page=2&tri=nom

$page = $_GET['page'] ?? 1;
$tri  = $_GET['tri']  ?? 'date';

// Toujours valider
$page = (int) $page;
if ($page < 1) $page = 1;
```

Données visibles dans l'URL.
Utilisé pour la navigation, les filtres.

</div>
<div>

**$_POST — formulaire**

```php
// Traitement d'un formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom   = trim($_POST['nom']   ?? '');
    $email = trim($_POST['email'] ?? '');

    if (empty($nom)) {
        $erreur = "Le nom est requis.";
    }
}
```

Données non visibles dans l'URL.
Utilisé pour les formulaires de saisie.

</div>
</div>

---

# $_SESSION

La session permet de **conserver des données entre les pages**.

```php
<?php
session_start(); // À appeler en tout premier, avant tout echo

// Stocker des données
$_SESSION['utilisateur'] = 'Alice';
$_SESSION['panier'][]    = ['produit' => 'Stylo', 'prix' => 1.50];

// Lire des données
$nom = $_SESSION['utilisateur'] ?? 'Invité';
echo "Bonjour, $nom !";

// Supprimer une clé
unset($_SESSION['panier']);

// Détruire toute la session (déconnexion)
session_destroy();
```

> `session_start()` doit être appelé **avant tout affichage** (même un espace ou une ligne vide).

---

# Débogage : var_dump et print_r

<div class="columns">
<div>

**`var_dump()`** — type + valeur

```php
$data = ["Alice", 22, true, null];

var_dump($data);
```

```text
array(4) {
  [0]=> string(5) "Alice"
  [1]=> int(22)
  [2]=> bool(true)
  [3]=> NULL
}
```

Indispensable pour voir les **types exacts**.

</div>
<div>

**`print_r()`** — structure lisible

```php
$user = [
  'nom'   => 'Alice',
  'roles' => ['admin', 'user']
];

echo "<pre>";
print_r($user);
echo "</pre>";
```

```text
Array
(
  [nom] => Alice
  [roles] => Array
    ( [0] => admin )
)
```

</div>
</div>

---

# Le piège : `==` vs `===`

`==` compare les **valeurs** avec conversion de type.
`===` compare les **valeurs ET les types** — à préférer.

```php
var_dump(0   == "a");      // true  — piège !
var_dump(0   === "a");     // false — correct

var_dump("1" == 1);        // true
var_dump("1" === 1);       // false

var_dump(""  == false);    // true
var_dump(""  === false);   // false

var_dump(null == false);   // true
var_dump(null === false);  // false
```

> **Règle :** utiliser `===` par défaut. N'utiliser `==` que si la conversion de type est intentionnelle.

---

# POO : classe et objet

```php
<?php

class Produit {

    // Propriétés
    public string $nom;
    public float  $prix;
    public int    $stock;

    // Constructeur
    public function __construct(string $nom, float $prix, int $stock) {
        $this->nom   = $nom;
        $this->prix  = $prix;
        $this->stock = $stock;
    }

    // Méthode
    public function afficher(): void {
        echo "{$this->nom} — {$this->prix} € (stock : {$this->stock})";
    }
}

$stylo = new Produit("Stylo", 1.50, 100);
$stylo->afficher(); // Stylo — 1.5 € (stock : 100)
```

---

# POO : encapsulation

L'encapsulation **protège** les propriétés et contrôle leur accès.

```php
class CompteBancaire {

    private float $solde; // inaccessible de l'extérieur

    public function __construct(float $soldeInitial) {
        $this->solde = $soldeInitial;
    }

    public function getSolde(): float {       // getter
        return $this->solde;
    }

    public function deposer(float $montant): void {
        if ($montant > 0) $this->solde += $montant;
    }
}

$compte = new CompteBancaire(500.0);
// $compte->solde = -9999;   // Erreur ! propriété private
$compte->deposer(200);
echo $compte->getSolde();    // 700
```

---

# POO : héritage

```php
class Animal {
    protected string $nom;

    public function __construct(string $nom) {
        $this->nom = $nom;
    }

    public function parler(): string {
        return "{$this->nom} fait un son.";
    }
}

class Chien extends Animal {
    private string $race;

    public function __construct(string $nom, string $race) {
        parent::__construct($nom); // appel du constructeur parent
        $this->race = $race;
    }

    public function parler(): string { // surcharge
        return "{$this->nom} aboie !";
    }
}

$rex = new Chien("Rex", "Labrador");
echo $rex->parler(); // Rex aboie !
```

---

# Sécurité : échapper les sorties

Toute donnée venant de l'utilisateur doit être **échappée avant affichage** pour éviter les injections XSS.

<div class="columns">
<div>

**Sans échappement — dangereux**

```php
// L'utilisateur a soumis :
// <script>alert('XSS')</script>

$nom = $_POST['nom'];
echo "<p>Bonjour $nom</p>";
// Le script s'exécute !
```

</div>
<div>

**Avec htmlspecialchars — sécurisé**

```php
$nom = htmlspecialchars(
    $_POST['nom'],
    ENT_QUOTES,
    'UTF-8'
);
echo "<p>Bonjour $nom</p>";
// Affiché comme texte brut
```

</div>
</div>

`htmlspecialchars()` convertit les caractères dangereux :

| Original | Converti |
|----------|----------|
| `<` | `&lt;` |
| `>` | `&gt;` |
| `"` | `&quot;` |
| `'` | `&#039;` |

---

# Téléversement de fichiers

```php
<!-- Formulaire HTML — enctype obligatoire -->
<form method="post" enctype="multipart/form-data">
  <input type="file" name="cv">
  <button>Envoyer</button>
</form>
```

```php
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fichier = $_FILES['cv'];

    // 1. Vérifier qu'un fichier a été reçu
    if ($fichier['error'] !== UPLOAD_ERR_OK) { die("Erreur d'upload."); }

    // 2. Vérifier le type MIME
    if ($fichier['type'] !== 'application/pdf') { die("PDF uniquement."); }

    // 3. Vérifier la taille (max 2 Mo)
    if ($fichier['size'] > 2 * 1024 * 1024) { die("Fichier trop lourd."); }

    // 4. Déplacer vers le dossier cible
    move_uploaded_file($fichier['tmp_name'], 'uploads/' . basename($fichier['name']));
    echo "Fichier déposé avec succès.";
}
```

---

# À retenir

1. PHP s'exécute **côté serveur** — le navigateur ne voit que du HTML
2. Utiliser `mb_*` pour toutes les chaînes en **français** (UTF-8)
3. Utiliser `===` (identique) plutôt que `==` (égal avec coercition)
4. `$_POST`, `$_GET`, `$_SESSION`, `$_FILES` → les superglobales clés
5. `session_start()` **avant tout** affichage
6. Toujours **échapper** les données affichées : `htmlspecialchars()`
7. `var_dump()` est votre meilleur ami pour déboguer

**La règle d'or :**
> Ne jamais faire confiance à une donnée venant de l'extérieur (formulaire, URL, fichier).

---

<!-- _class: title -->

# Questions ?
