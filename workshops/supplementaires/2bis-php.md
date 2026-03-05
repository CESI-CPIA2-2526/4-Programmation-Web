# Workshop 2bis - PHP : Exercices

## Exercice 1 : Catalogue de bibliotheque

**Contexte :** Vous developpez un script de gestion interne pour une petite bibliotheque.
Jusqu'ici tout votre code PHP se trouve dans un seul fichier. L'objectif de cet exercice est de commencer a **separer les donnees de l'affichage**, ce qui est le premier pas vers MVC.

**Structure de fichiers a respecter :**

```text
exercice1/
├── index.php
├── models/
│   └── LivreModel.php
└── views/
    └── catalogue.php
```

### Question 1 - Le Model : donnees et logique

Creer `models/LivreModel.php`. Ce fichier ne doit **rien afficher** : il contient uniquement des donnees et des fonctions qui retournent des resultats.

Declarer un tableau `$livres` contenant au moins 6 livres avec les proprietes suivantes :

| Propriete | Type | Description |
|-----------|------|-------------|
| `titre` | string | Titre du livre |
| `auteur` | string | Nom de l'auteur |
| `annee` | int | Annee de publication |
| `disponible` | bool | Disponibilite en rayon |
| `note` | float | Note moyenne sur 5 |

Ecrire les fonctions suivantes dans ce fichier (elles operent sur `$livres`) :

- `getTousLesLivres(): array` - retourne le tableau complet
- `getNombreDisponibles(): int` - compte les livres disponibles sans `array_filter()`
- `getNoteMoyenne(): float` - calcule la moyenne des notes sans `array_sum()`
- `getMeilleurLivre(): array` - retourne le livre avec la note la plus haute

### Question 2 - La View : affichage uniquement

Creer `views/catalogue.php`. Cette vue **ne calcule rien** : elle recoit des variables et les affiche uniquement.

La vue doit afficher :

- La liste des livres avec ce format :

```text
[DISPONIBLE] "Le Nom de la Rose" par Umberto Eco (1980) - Note : 4.5/5
[EMPRUNTE]   "Dune" par Frank Herbert (1965) - Note : 4.8/5
```

- Un encadre de statistiques affichant les resultats des trois fonctions du Model

### Question 3 - Le point d'entree

Creer `index.php`. Ce fichier joue le role de **controller minimal** : il inclut le Model, appelle les fonctions, puis inclut la View en lui passant les donnees via des variables.

```php
<?php
require_once 'models/LivreModel.php';

$livres        = getTousLesLivres();
$nbDispo       = getNombreDisponibles();
$noteMoyenne   = getNoteMoyenne();
$meilleurLivre = getMeilleurLivre();

require_once 'views/catalogue.php';
```

Verifier que la View n'utilise que les variables passees par `index.php` et n'appelle aucune fonction du Model directement.

### Question 4 - Manipulation de chaines dans le Model

Ajouter dans `LivreModel.php` une fonction `formaterCoteArchive(string $titre, string $auteur): string` qui retourne une chaine normalisee :

- Tout en majuscules avec `mb_strtoupper()`
- Les espaces remplaces par des tirets
- Titre et auteur separes par `--`
- Exemple : `"Le Nom de la Rose"` + `"Umberto Eco"` → `"LE-NOM-DE-LA-ROSE--UMBERTO-ECO"`

Afficher la cote d'archivage de chaque livre dans la View, en appelant la fonction depuis `index.php` et en passant le resultat a la View (pas depuis la View directement).

---

## Exercice 2 : Formulaire d'inscription avec debogage

**Contexte :** Vous creez un formulaire d'inscription pour une plateforme etudiante.
Cet exercice introduit le **Controller** comme point d'entree unique qui traite les requetes HTTP, appelle le Model et choisit quelle View afficher.

**Structure de fichiers a respecter :**

```text
exercice2/
├── index.php
├── controllers/
│   └── InscriptionController.php
├── models/
│   └── InscritModel.php
└── views/
    ├── formulaire.php
    └── confirmation.php
```

### Question 1 - Le Controller et le routage

Creer `index.php` qui inclut et appelle `InscriptionController.php`.

Creer `controllers/InscriptionController.php`. Ce fichier doit :

- Verifier si la requete est un POST avec `$_SERVER['REQUEST_METHOD']`
- Si POST : appeler le Model pour valider et enregistrer, puis charger `views/confirmation.php`
- Si GET : charger `views/formulaire.php`

```php
<?php
require_once 'models/InscritModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $erreurs = validerInscription($_POST);
    if (empty($erreurs)) {
        enregistrerInscrit($_POST);
        $inscrits = getTousLesInscrits();
        require_once 'views/confirmation.php';
    } else {
        require_once 'views/formulaire.php';
    }
} else {
    require_once 'views/formulaire.php';
}
```

### Question 2 - Le Model : validation et session

Creer `models/InscritModel.php`. Ce fichier ne doit **pas afficher** de HTML.

Le formulaire collecte les champs : `prenom`, `nom`, `email`, `promo` (B1 a M2), `cgu` (checkbox).

Ecrire les fonctions :

- `validerInscription(array $post): array` - retourne un tableau d'erreurs (vide si tout est valide). Verifier chaque champ et que la CGU est cochee.
- `enregistrerInscrit(array $post): void` - demarre la session si besoin et ajoute l'inscrit dans `$_SESSION['inscrits']`
- `getTousLesInscrits(): array` - retourne `$_SESSION['inscrits']` ou un tableau vide

### Question 3 - Les Views

Creer `views/formulaire.php` : affiche le formulaire HTML (methode POST vers `index.php`). Si la variable `$erreurs` est definie et non vide, afficher les messages d'erreur au-dessus du formulaire.

Creer `views/confirmation.php` : affiche un message de succes et le tableau de tous les inscrits (prenom, nom, promo). Toutes les donnees affichees passent par `htmlspecialchars()`.

### Question 4 - Debogage avec var_dump

Dans le Controller, ajouter un mode debug active par une constante :

```php
define('DEBUG', true);
```

Si `DEBUG` est `true`, afficher avant le traitement un bloc `<pre>` contenant `var_dump($_POST)` et `var_dump($_SESSION)`.

Puis analyser ces comparaisons dans un commentaire du Controller. Pour chacune, ecrire le resultat attendu et expliquer pourquoi :

```php
$promo = "";
var_dump($promo == false);    // ?
var_dump($promo === false);   // ?
var_dump(isset($promo));      // ?
var_dump(empty($promo));      // ?

// Checkbox CGU non cochee
var_dump(isset($_POST['cgu']));
var_dump($_POST['cgu'] ?? "non defini");
```

Ajouter aussi dans `views/formulaire.php` un tableau HTML "Infos serveur" affichant `REQUEST_METHOD`, `REMOTE_ADDR`, `HTTP_USER_AGENT` et `REQUEST_URI` issus de `$_SERVER`.

---

## Exercice 3 : Systeme de gestion du personnel

**Contexte :** Vous modelisez le personnel d'une agence web.
Cet exercice montre que **les classes POO sont naturellement les Models** dans MVC : elles encapsulent les donnees et les comportements metier. Le Controller instancie les objets et prepare les donnees pour la View.

**Structure de fichiers a respecter :**

```text
exercice3/
├── index.php
├── controllers/
│   └── PersonnelController.php
├── models/
│   ├── Employe.php
│   ├── Developpeur.php
│   └── ChefDeProjet.php
└── views/
    └── equipe.php
```

### Question 1 - Les Models : classe de base

Creer `models/Employe.php` avec la classe `Employe` :

| Element | Visibilite | Specification |
|---------|-----------|---------------|
| `$nom` | protected | Nom complet |
| `$email` | private | Adresse email |
| `$salaire` | private | Salaire mensuel brut |
| `__construct()` | public | Initialise les trois proprietes |
| `getEmail()` | public | Retourne l'email |
| `getSalaire()` | public | Retourne le salaire |
| `augmenter(float $pourcent)` | public | Augmente le salaire du pourcentage donne |
| `toArray()` | public | Retourne un tableau associatif des donnees de l'employe |

La methode `toArray()` est la **seule sortie de donnees du Model** : elle permet a la View d'acceder aux donnees sans connaitre la classe. Elle ne fait pas de `echo`.

### Question 2 - Heritage : les sous-classes sont aussi des Models

Creer `models/Developpeur.php` (herite de `Employe`) :

| Element | Specification |
|---------|--------------|
| `$langages` | Tableau de langages (ex : `["PHP", "JS"]`) |
| `$niveauSeniorite` | `"junior"`, `"mid"` ou `"senior"` |
| `ajouterLangage(string $lang)` | Ajoute un langage s'il n'est pas deja present |
| `toArray()` | Surcharge : appelle `parent::toArray()` et ajoute `langages` et `seniorite` |

Creer `models/ChefDeProjet.php` (herite de `Employe`) :

| Element | Specification |
|---------|--------------|
| `$projets` | Tableau de noms de projets |
| `$budget` | Budget total gere |
| `ajouterProjet(string $nom)` | Ajoute un projet au tableau |
| `toArray()` | Surcharge : ajoute `projets` et `budget` |

### Question 3 - Le Controller : orchestration

Creer `controllers/PersonnelController.php`. Ce fichier :

- Inclut les trois fichiers de classes
- Instancie une equipe de 4 a 5 employes (mix de Developpeurs et ChefDeProjet)
- Appelle `augmenter()` sur certains employes
- Construit un tableau `$equipe` en appelant `toArray()` sur chaque objet
- Calcule la masse salariale totale et les comptages par type avec `instanceof`
- Passe toutes ces donnees a la View via des variables

**Regle importante :** Le Controller ne fait aucun `echo`. Toute l'affichage appartient a la View.

### Question 4 - Encapsulation et la View

Creer `views/equipe.php` qui affiche :

- Un tableau HTML de l'equipe (une ligne par employe, colonnes selon le type)
- La masse salariale totale
- Le nombre de developpeurs et de chefs de projet

Dans le Controller, tenter les acces suivants et expliquer en commentaire pourquoi ils echouent :

```php
$dev = new Developpeur("Alice", "alice@agence.fr", 3200, ["PHP"], "junior");

echo $dev->salaire;  // propriete private
echo $dev->nom;      // propriete protected
```

Montrer la correction via `getSalaire()` et `toArray()['nom']`.

---

## Exercice 4 : Espace de depot de documents

**Contexte :** Vous developpez un espace de depot de fichiers pour des etudiants qui soumettent leurs rendus PDF. Cet exercice met en place un **MVC complet** : un seul point d'entree, un Controller qui gere les deux actions (afficher le formulaire / traiter l'upload), un Model qui encapsule toute la logique metier, et des Views distinctes.

**Structure de fichiers a respecter :**

```text
exercice4/
├── index.php
├── controllers/
│   └── DepotController.php
├── models/
│   └── DepotModel.php
├── views/
│   ├── formulaire.php
│   └── confirmation.php
└── rendus/
```

### Question 1 - Le point d'entree et le Controller

Creer `index.php` qui se contente d'inclure et d'appeler le Controller.

Creer `controllers/DepotController.php` qui gere deux cas selon `$_SERVER['REQUEST_METHOD']` :

- **GET** : afficher `views/formulaire.php`
- **POST** : appeler `DepotModel::traiter($_POST, $_FILES)`, puis selon le resultat charger `views/confirmation.php` (succes) ou re-afficher `views/formulaire.php` avec un message d'erreur

Le Controller ne contient **aucune logique de validation ni de manipulation de fichier**.

### Question 2 - La View : formulaire de depot

Creer `views/formulaire.php` avec un formulaire HTML (`method="post"`, `enctype="multipart/form-data"`) contenant :

- Un champ texte pour le nom de l'etudiant
- Un `<select>` pour le module : PHP, JavaScript, SQL, Reseau
- Un input `type="file"` acceptant uniquement les PDF
- Un bouton Envoyer

Si la variable `$erreur` est definie, afficher le message en haut du formulaire.

### Question 3 - Le Model : validation et deplacement

Creer `models/DepotModel.php` avec une classe `DepotModel` contenant uniquement des methodes statiques.

**Methode `valider(array $post, array $files): string|null`**

Effectuer les validations dans l'ordre. Retourner le premier message d'erreur rencontre, ou `null` si tout est valide :

| Validation | Condition | Message |
|-----------|-----------|---------|
| Presence | `$files['fichier']['error'] !== UPLOAD_ERR_OK` | "Aucun fichier recu." |
| Type MIME | Pas `application/pdf` | "Seuls les fichiers PDF sont acceptes." |
| Taille | Superieure a 3 Mo (3 145 728 octets) | "Le fichier depasse 3 Mo." |
| Nom etudiant | Champ vide apres `trim()` | "Le nom de l'etudiant est requis." |

**Methode `deplacer(array $post, array $files): string`**

Generer un nom de fichier selon ce format : `[module]_[nom-etudiant]_[timestamp].pdf`

- Module en minuscules
- Nom de l'etudiant : `strtolower()` + `str_replace(' ', '-', ...)`
- Timestamp avec `time()`

Creer `rendus/` avec `mkdir()` si necessaire, deplacer le fichier avec `move_uploaded_file()`, retourner le nom de fichier genere.

**Methode `enregistrer(array $post, string $nomFichier): void`**

Demarrer la session si besoin et ajouter le depot dans `$_SESSION['depots']` avec : nom etudiant, module, nom de fichier, horodatage.

**Methode `getHistorique(): array`**

Retourner `$_SESSION['depots']` ou un tableau vide.

Le Controller appelle ces methodes dans l'ordre : `valider` → `deplacer` → `enregistrer`.

### Question 4 - La View : confirmation et historique securise

Creer `views/confirmation.php` qui affiche :

- Un message de succes avec le nom du fichier depose
- Un tableau HTML listant l'historique complet des depots de la session (nom, module, fichier, date)

**Securite obligatoire :** toutes les donnees affichees passent par `htmlspecialchars($valeur, ENT_QUOTES, 'UTF-8')`.

Tester en soumettant un nom d'etudiant contenant `<script>alert('XSS')</script>` et verifier que le code s'affiche comme texte brut dans le tableau d'historique.
