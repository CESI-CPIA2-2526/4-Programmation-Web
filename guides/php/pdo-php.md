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

# PDO : PHP Data Objects

## Connexion, requêtes préparées, sécurité

---

# PDO, c'est quoi ?

**PDO** est l'extension PHP standard pour communiquer avec une base de données.

```text
PHP (PDO)  --(requête SQL)-->  Base de données
                                   | MySQL
           <--(résultats)--        | PostgreSQL
                                   | SQLite
```

- **Une seule API** pour tous les systèmes de bases de données
- Protection native contre les **injections SQL** via les requêtes préparées
- Gestion des erreurs via les **exceptions**

| | PDO | mysqli |
|--|-----|--------|
| Multi-SGBD | Oui | Non (MySQL uniquement) |
| Requêtes préparées | Oui | Oui |
| API orientée objet | Oui | Oui |

> **PDO est la méthode recommandée** pour tout nouveau projet PHP.

---

# Connexion à la base de données

```php
<?php

$hote = 'localhost';
$base = 'ma_base';
$user = 'root';
$pass = 'motdepasse';

try {
    $pdo = new PDO(
        "mysql:host=$hote;dbname=$base;charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    die("Connexion impossible : " . $e->getMessage());
}
```

> Les options définissent le comportement global :
> - `ERRMODE_EXCEPTION` : les erreurs lèvent une exception
> - `FETCH_ASSOC` : résultats sous forme de tableaux associatifs
> - `EMULATE_PREPARES false` : vraies requêtes préparées côté serveur

---

# Classe Database : connexion unique

Centraliser la connexion dans une classe évite de la répéter partout.

```php
<?php

class Database {

    private static ?PDO $instance = null;

    public static function getConnection(): PDO {
        if (self::$instance === null) {
            self::$instance = new PDO(
                "mysql:host=localhost;dbname=ma_base;charset=utf8mb4",
                "root",
                "motdepasse",
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]
            );
        }
        return self::$instance;
    }
}

// Utilisation
$pdo = Database::getConnection();
```

---

# SELECT : récupérer des données

<div class="columns">
<div>

**`fetchAll()` : toutes les lignes**

```php
$stmt = $pdo->query("SELECT * FROM produits");

$produits = $stmt->fetchAll();

foreach ($produits as $produit) {
    echo $produit['nom'];
    echo $produit['prix'];
}
```

Retourne un tableau de toutes les lignes.
A utiliser pour afficher une liste.

</div>
<div>

**`fetch()` : une seule ligne**

```php
$stmt = $pdo->query(
    "SELECT * FROM produits LIMIT 1"
);

$produit = $stmt->fetch();

if ($produit) {
    echo $produit['nom'];
} else {
    echo "Aucun produit trouvé.";
}
```

Retourne la prochaine ligne, ou `false`.
A utiliser pour récupérer un enregistrement.

</div>
</div>

> `query()` est réservé aux requêtes **sans données variables**.
> Dès qu'une variable entre dans la requête, utiliser une **requête préparée**.

---

# Requête préparée : pourquoi ?

Sans requête préparée, une variable malveillante peut **modifier la requête SQL**.

<div class="columns">
<div>

**Sans préparation : dangereux**

```php
// L'utilisateur saisit :
// ' OR '1'='1

$id = $_GET['id'];

$stmt = $pdo->query(
    "SELECT * FROM users WHERE id = $id"
);
// Requête exécutée :
// SELECT * FROM users
// WHERE id = '' OR '1'='1'
// Retourne TOUS les utilisateurs !
```

</div>
<div>

**Avec requête préparée : sécurisé**

```php
$id = $_GET['id'];

$stmt = $pdo->prepare(
    "SELECT * FROM users WHERE id = :id"
);
$stmt->execute([':id' => $id]);

$user = $stmt->fetch();
```

PDO **échappe** automatiquement la valeur.
La structure de la requête ne peut pas être modifiée.

</div>
</div>

---

# Requêtes préparées : syntaxe

<div class="columns">
<div>

**Paramètres nommés (`:nom`)**

```php
$stmt = $pdo->prepare(
    "SELECT * FROM produits
     WHERE categorie = :cat
       AND prix < :max"
);

$stmt->execute([
    ':cat' => 'électronique',
    ':max' => 500,
]);

$produits = $stmt->fetchAll();
```

Plus lisible quand il y a plusieurs paramètres.

</div>
<div>

**Paramètres positionnels (`?`)**

```php
$stmt = $pdo->prepare(
    "SELECT * FROM produits
     WHERE categorie = ?
       AND prix < ?"
);

$stmt->execute(['électronique', 500]);

$produits = $stmt->fetchAll();
```

Plus court, mais l'ordre des valeurs doit correspondre à l'ordre des `?`.

</div>
</div>

> Les deux syntaxes sont équivalentes. Choisir l'une et s'y tenir.

---

# INSERT : insérer des données

```php
<?php

$stmt = $pdo->prepare(
    "INSERT INTO produits (nom, prix, stock)
     VALUES (:nom, :prix, :stock)"
);

$stmt->execute([
    ':nom'   => 'Stylo',
    ':prix'  => 1.50,
    ':stock' => 100,
]);

// Récupérer l'ID auto-incrémenté du nouvel enregistrement
$nouvelId = $pdo->lastInsertId();
echo "Produit créé avec l'ID : $nouvelId";
```

> `lastInsertId()` retourne l'ID généré par la dernière insertion.
> Utile pour créer des enregistrements liés juste après.

---

# UPDATE et DELETE

<div class="columns">
<div>

**UPDATE : modifier**

```php
$stmt = $pdo->prepare(
    "UPDATE produits
     SET prix  = :prix,
         stock = :stock
     WHERE id = :id"
);

$stmt->execute([
    ':prix'  => 2.00,
    ':stock' => 50,
    ':id'    => 5,
]);

// Nombre de lignes modifiées
$nbModifies = $stmt->rowCount();
echo "$nbModifies ligne(s) mise(s) à jour.";
```

</div>
<div>

**DELETE : supprimer**

```php
$stmt = $pdo->prepare(
    "DELETE FROM produits
     WHERE id = :id"
);

$stmt->execute([':id' => 5]);

// Nombre de lignes supprimées
$nbSupprimes = $stmt->rowCount();

if ($nbSupprimes === 0) {
    echo "Aucun produit trouvé.";
} else {
    echo "Produit supprimé.";
}
```

</div>
</div>

> `rowCount()` retourne le nombre de lignes **affectées** par le dernier UPDATE ou DELETE.

---

# Les modes de fetch

Le mode de fetch détermine **sous quelle forme** les données sont retournées.

| Mode | Résultat | Usage |
|------|----------|-------|
| `PDO::FETCH_ASSOC` | Tableau associatif | Par défaut, recommandé |
| `PDO::FETCH_OBJ` | Objet `stdClass` | Accès via `->propriété` |
| `PDO::FETCH_CLASS` | Instance d'une classe | Architecture MVC |
| `PDO::FETCH_NUM` | Tableau indexé | Rarement utile |

```php
// FETCH_ASSOC (défaut configuré à la connexion)
$produit = $stmt->fetch();
echo $produit['nom'];

// FETCH_OBJ pour cette requête uniquement
$produit = $stmt->fetch(PDO::FETCH_OBJ);
echo $produit->nom;

// FETCH_CLASS hydrate directement un objet Produit
$stmt->setFetchMode(PDO::FETCH_CLASS, 'Produit');
$produit = $stmt->fetch(); // instance de Produit
```

---

# FETCH_CLASS : hydratation automatique

```php
<?php

class Produit {
    public int    $id;
    public string $nom;
    public float  $prix;
    public int    $stock;

    public function estDisponible(): bool {
        return $this->stock > 0;
    }

    public function afficher(): string {
        $statut = $this->estDisponible() ? 'disponible' : 'épuisé';
        return "{$this->nom} - {$this->prix} EUR ({$statut})";
    }
}

// Hydratation automatique via PDO
$stmt = $pdo->query("SELECT * FROM produits");
$stmt->setFetchMode(PDO::FETCH_CLASS, 'Produit');

$produits = $stmt->fetchAll();
foreach ($produits as $produit) {
    echo $produit->afficher();
}
```

> PDO remplit les propriétés de la classe **automatiquement** à partir des colonnes SQL.

---

# Les transactions

Une **transaction** garantit que plusieurs requêtes s'exécutent **toutes ou aucune**.

```php
<?php

try {
    $pdo->beginTransaction();

    // Débiter le compte source
    $stmt = $pdo->prepare(
        "UPDATE comptes SET solde = solde - :montant WHERE id = :id"
    );
    $stmt->execute([':montant' => 200, ':id' => 1]);

    // Créditer le compte cible
    $stmt = $pdo->prepare(
        "UPDATE comptes SET solde = solde + :montant WHERE id = :id"
    );
    $stmt->execute([':montant' => 200, ':id' => 2]);

    $pdo->commit(); // valider les deux modifications
    echo "Virement effectué.";

} catch (PDOException $e) {
    $pdo->rollBack(); // annuler tout en cas d'erreur
    echo "Erreur, virement annulé : " . $e->getMessage();
}
```

---

# Gestion des erreurs

Avec `ERRMODE_EXCEPTION`, toute erreur SQL lève une `PDOException`.

```php
<?php

try {
    $stmt = $pdo->prepare(
        "SELECT * FROM table_inexistante WHERE id = :id"
    );
    $stmt->execute([':id' => 1]);
    $data = $stmt->fetchAll();

} catch (PDOException $e) {
    // En développement : afficher le message
    echo "Erreur SQL : " . $e->getMessage();

    // En production : logger l'erreur, afficher un message générique
    error_log($e->getMessage());
    echo "Une erreur est survenue. Veuillez réessayer.";
}
```

> Ne jamais afficher `$e->getMessage()` en **production** : le message peut révéler la structure de la base.
> Logger en interne, afficher un message neutre à l'utilisateur.

---

# Exemple complet : modèle MVC

```php
<?php

class ProduitModel {

    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    public function findAll(): array {
        $stmt = $this->pdo->query("SELECT * FROM produits ORDER BY nom");
        return $stmt->fetchAll();
    }

    public function findById(int $id): array|false {
        $stmt = $this->pdo->prepare("SELECT * FROM produits WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function create(string $nom, float $prix, int $stock): int {
        $stmt = $this->pdo->prepare(
            "INSERT INTO produits (nom, prix, stock) VALUES (:nom, :prix, :stock)"
        );
        $stmt->execute([':nom' => $nom, ':prix' => $prix, ':stock' => $stock]);
        return (int) $this->pdo->lastInsertId();
    }

    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM produits WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->rowCount() > 0;
    }
}
```

---

# A retenir

1. Toujours passer les options `ERRMODE_EXCEPTION`, `FETCH_ASSOC`, `EMULATE_PREPARES false` à la connexion
2. **Jamais** de variable directement dans une requête SQL : utiliser `prepare` + `execute`
3. `query()` uniquement pour les requêtes **sans paramètres**
4. `fetch()` pour une ligne, `fetchAll()` pour toutes les lignes
5. `lastInsertId()` après un `INSERT`, `rowCount()` après un `UPDATE` ou `DELETE`
6. Entourer les opérations critiques d'une **transaction** (`beginTransaction` / `commit` / `rollBack`)
7. Ne jamais afficher `$e->getMessage()` en production

**La règle d'or :**
> Une requête préparée sépare les données de la structure SQL et protège contre les injections.

---

<!-- _class: title -->

# Questions ?
