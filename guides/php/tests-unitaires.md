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

# Tests unitaires en PHP

## PHPUnit : écrire, organiser et automatiser ses tests

---

# Pourquoi tester son code ?

Sans tests, chaque modification peut casser quelque chose sans qu'on le sache.

**Les tests permettent de :**
- Vérifier qu'une fonction produit le résultat attendu
- Détecter les régressions lors d'une modification
- Documenter le comportement attendu du code
- Refactoriser avec confiance

**Les types de tests :**

| Type | Ce qu'on teste | Exemple |
|------|----------------|---------|
| **Unitaire** | Une fonction ou méthode isolée | `calculerTVA(100)` retourne `20` |
| **Intégration** | Plusieurs composants ensemble | Un modèle qui interroge la BDD |
| **Fonctionnel** | Le comportement depuis l'extérieur | Un formulaire soumis via HTTP |

> Ce guide se concentre sur les **tests unitaires** avec PHPUnit.

---

# PHPUnit : installation

PHPUnit s'installe via Composer.

```bash
composer require --dev phpunit/phpunit
```

Structure de projet recommandée :

```text
projet/
  src/
    Calculatrice.php
    Panier.php
  tests/
    CalculatriceTest.php
    PanierTest.php
  composer.json
  phpunit.xml
```

> Les fichiers de test sont dans `tests/`, séparés du code source.
> Par convention, le fichier de test d'une classe `Foo` s'appelle `FooTest`.

---

# Configuration : phpunit.xml

```xml
<?xml version="1.0" encoding="UTF-8"?>
<phpunit bootstrap="vendor/autoload.php" colors="true">
    <testsuites>
        <testsuite name="Application">
            <directory>tests</directory>
        </testsuite>
    </testsuites>
    <source>
        <include>
            <directory>src</directory>
        </include>
    </source>
</phpunit>
```

Lancer les tests :

```bash
./vendor/bin/phpunit
```

---

# Premier test : structure de base

```php
use PHPUnit\Framework\TestCase;

class CalculatriceTest extends TestCase {
    public function test_additionner_deux_nombres(): void {
        // Arrange : préparer les données
        $calc = new Calculatrice();
        // Act : appeler le code à tester
        $resultat = $calc->additionner(3, 5);
        // Assert : vérifier le résultat
        $this->assertEquals(8, $resultat);
    }
}
```

> La structure **Arrange / Act / Assert** (AAA) rend chaque test lisible et prévisible.
> Un test ne doit vérifier qu'**une seule chose** à la fois.

---

# La classe testée

```php
class Calculatrice {
    public function additionner(float $a, float $b): float {
        return $a + $b;
    }
    public function diviser(float $a, float $b): float {
        if ($b === 0.0) {
            throw new InvalidArgumentException("Division par zéro impossible.");
        }
        return $a / $b;
    }
}
```

---

# Les assertions principales

| Méthode | Vérifie que... |
|---------|----------------|
| `assertEquals($a, $b)` | `$a` est égal à `$b` |
| `assertSame($a, $b)` | `$a === $b` (valeur et type) |
| `assertTrue($val)` | `$val` est `true` |
| `assertFalse($val)` | `$val` est `false` |
| `assertNull($val)` | `$val` est `null` |
| `assertCount($n, $tab)` | le tableau contient `$n` éléments |
| `assertEmpty($val)` | la valeur est vide |
| `assertInstanceOf($class, $obj)` | `$obj` est une instance de `$class` |
| `assertStringContainsString($s, $str)` | `$str` contient la sous-chaine `$s` |

> `assertEquals` compare les valeurs, `assertSame` compare aussi le type.
> Préférer `assertSame` pour éviter les faux positifs liés au transtypage.

---

# Tester les exceptions

```php
class CalculatriceTest extends TestCase {
    public function test_diviser_par_zero_leve_une_exception(): void {
        $calc = new Calculatrice();
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Division par zéro impossible.");
        $calc->diviser(10, 0);
    }
    public function test_diviser_deux_nombres(): void {
        $resultat = (new Calculatrice())->diviser(10, 2);
        $this->assertSame(5.0, $resultat);
    }
}
```

> `expectException()` doit être appelé **avant** le code qui lève l'exception.

---

# Data providers : tester plusieurs cas

Eviter de dupliquer les tests en fournissant plusieurs jeux de données.

```php
use PHPUnit\Framework\Attributes\DataProvider;

class CalculatriceTest extends TestCase {
    #[DataProvider('casAddition')]
    public function test_additionner(float $a, float $b, float $attendu): void {
        $this->assertSame($attendu, (new Calculatrice())->additionner($a, $b));
    }
    public static function casAddition(): array {
        return [
            'entiers positifs' => [3.0,  5.0,  8.0],
            'avec négatif'     => [-2.0, 4.0,  2.0],
            'deux négatifs'    => [-1.0, -1.0, -2.0],
            'zéros'            => [0.0,  0.0,  0.0],
        ];
    }
}
```

> PHPUnit exécute le test une fois par entrée. Les clés servent de libellés dans le rapport.

---

# setUp et tearDown

`setUp()` s'exécute avant chaque test, `tearDown()` après.

```php
class PanierTest extends TestCase {
    private Panier $panier;
    protected function setUp(): void {
        $this->panier = new Panier();
        $this->panier->ajouter(new Produit('Stylo', 1.50), 2);
    }
    public function test_total_initial(): void {
        $this->assertSame(3.0, $this->panier->total());
    }
    public function test_vider_le_panier(): void {
        $this->panier->vider();
        $this->assertCount(0, $this->panier->lignes());
    }
}
```

> `setUp()` évite de répéter l'initialisation dans chaque test.
> Chaque test repart d'un état propre et indépendant.

---

# Tester un modèle avec une base de données

Pour tester sans toucher à la vraie BDD, on utilise une base SQLite en mémoire.

```php
class ProduitModelTest extends TestCase {
    private ProduitModel $model;
    protected function setUp(): void {
        $pdo = new PDO('sqlite::memory:');
        $pdo->exec("CREATE TABLE produits (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nom TEXT NOT NULL, prix REAL NOT NULL, stock INTEGER NOT NULL
        )");
        $this->model = new ProduitModel($pdo);
    }
    public function test_create_retourne_un_id(): void {
        $id = $this->model->create('Crayon', 0.80, 50);
        $this->assertGreaterThan(0, $id);
    }
    public function test_find_by_id_retourne_le_produit(): void {
        $id = $this->model->create('Crayon', 0.80, 50);
        $produit = $this->model->findById($id);
        $this->assertSame('Crayon', $produit['nom']);
    }
}
```

---

# Les mocks : isoler les dépendances

Un **mock** remplace une dépendance réelle par un objet simulé.

```php
class CommandeServiceTest extends TestCase {
    public function test_passer_commande_envoie_un_email(): void {
        $mailer = $this->createMock(MailerInterface::class);
        $mailer->expects($this->once())
               ->method('send')
               ->with(
                   $this->equalTo('client@example.com'),
                   $this->stringContains('Confirmation')
               );
        $service = new CommandeService($mailer);
        $service->passerCommande('client@example.com', []);
    }
}
```

> Un mock permet de tester une classe sans dépendre d'un vrai serveur mail, d'une API externe ou d'une base de données.

---

# Interpréter le rapport de tests

```text
...F.E.                                                     6 / 6 (100%)

There was 1 failure:
1) CalculatriceTest::test_diviser_deux_nombres
   Failed asserting that 4.0 is identical to 5.0.

There was 1 error:
1) PanierTest::test_vider_le_panier
   Error: Call to undefined method Panier::vider()
```

| Symbole | Signification |
|---------|---------------|
| `.` | Test passé |
| `F` | Assertion échouée (le résultat est faux) |
| `E` | Erreur PHP (exception non gérée, méthode manquante) |
| `S` | Test ignoré (`markTestSkipped`) |

---

# Bonnes pratiques

**Nommer les tests clairement**

```php
// Mauvais
public function test1(): void { ... }

// Bien
public function test_findById_retourne_false_si_id_inexistant(): void { ... }
```

**Un test, une assertion principale**

```php
// A eviter : trop de vérifications dans un seul test
public function test_create(): void {
    $id = $this->model->create('A', 1.0, 10);
    $produit = $this->model->findById($id);
    $this->assertSame('A', $produit['nom']);
    $this->assertSame(1.0, $produit['prix']);
    $this->assertCount(1, $this->model->findAll()); // trop
}
```

> Chaque test doit pouvoir s'exécuter seul, dans n'importe quel ordre.
> Ne jamais faire dépendre un test du résultat d'un autre.

---

# Couverture de code

PHPUnit peut mesurer quelles lignes de code sont couvertes par les tests.

```bash
./vendor/bin/phpunit --coverage-html coverage/
```

Ouvrir `coverage/index.html` dans un navigateur pour voir le rapport.

```text
Calculatrice
  additionner   100%  ||||||||||||
  diviser        75%  |||||||||...
```

> La couverture indique les zones non testées, mais 100% ne garantit pas l'absence de bugs.
> Viser une couverture élevée sur la logique métier, pas sur le code de configuration.

---

# A retenir

1. Un test suit la structure **Arrange / Act / Assert**
2. Chaque test vérifie **une seule chose** et est **indépendant** des autres
3. `setUp()` initialise l'état commun avant chaque test
4. Les **data providers** évitent de dupliquer les tests pour plusieurs cas
5. Les **mocks** isolent la classe testée de ses dépendances externes
6. Tester les cas **nominaux** et les cas **limites** (valeur nulle, liste vide, exception)
7. Un bon nom de test décrit le comportement vérifié, pas l'implémentation

**La règle d'or :**
> Un test qui ne peut pas échouer ne sert a rien. Ecrire le test avant de corriger un bug garantit qu'il détectera la régression.

---

<!-- _class: title -->

# Questions ?
