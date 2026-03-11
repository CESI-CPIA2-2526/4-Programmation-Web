# Mini-Projet : La Canardothèque

## Contexte du Projet

L'association étudiante **"Club Coin-Coin"** met à disposition de ses membres une vaste collection de canards (canards de bain anti-stress, peluches géantes, bouées pour les événements du campus). Face à la perte fréquente de matériel, le président de l'association a besoin d'une application web intranet pour informatiser la gestion de son inventaire et le suivi des prêts.

**Vous avez 6 heures pour concevoir et développer la première version fonctionnelle de cet outil.**

> Ce projet est avant tout un exercice de **modélisation et de développement back-end**. Le rendu visuel n'est pas évalué. Lisez l'intégralité du cahier des charges, réalisez votre MCD sur papier, puis seulement commencez à coder.

---

## 1. Spécifications Fonctionnelles

### A. Gestion du cheptel - Les Canards

- Consulter la **liste complète** des canards (nom, type, état).
- **Ajouter** un nouveau canard en renseignant :
  - Son petit nom (ex : *Amiral Bec-Jaune*)
  - Son type parmi : `Plastique`, `Peluche`, `Bouée`
  - Son état initial
- Les états possibles d'un canard sont **strictement limités** à :
  - `Dans la mare` *(disponible à l'emprunt)*
  - `En vadrouille` *(actuellement emprunté)*
  - `En nettoyage` *(indisponible temporairement)*

### B. Gestion des emprunteurs - Les Étudiants

- Consulter la **liste des étudiants** inscrits au service.
- **Enregistrer** un nouvel étudiant en renseignant :
  - Son numéro de carte étudiante *(identifiant unique, saisi manuellement)*
  - Son nom et prénom
  - Son adresse email universitaire

### C. Gestion des emprunts - Les Adoptions Temporaires

- Depuis la liste des canards, un bouton **"Adopter"** doit apparaître **uniquement** pour les canards dont l'état est `Dans la mare`.
- L'action d'emprunt associe un canard à un étudiant inscrit en précisant :
  - La date du prêt (date du jour)
  - La date de retour prévue
- **Règle métier obligatoire :** la validation d'un emprunt doit **automatiquement** changer l'état du canard de `Dans la mare` à `En vadrouille`.

---

## 2. Modélisation - MCD

**C'est la première étape, obligatoire avant tout code.**

### Ce qu'on attend

Vous devez produire un **Modèle Conceptuel de Données (MCD)** complet représentant les trois entités du système et leurs relations. Vous pouvez le réaliser sur papier, avec [Looping](https://www.looping-mcd.fr/), ou avec draw.io.

### Rappel de notation

Un MCD se compose d'**entités** (rectangles), de **relations** (ellipses ou losanges), et de **cardinalités** (annotations sur les pattes).

```text
ETUDIANT --(0,n)-- EMPRUNTER --(0,1)-- CANARD
                       |
                   date_pret
                   date_retour
```

- Une entité possède des **attributs** (ex : nom, prénom) dont l'un est l'**identifiant** (souligné).
- Une relation peut elle aussi porter des attributs (ex : les dates d'un emprunt).
- Les **cardinalités** expriment combien de fois une entité peut participer à une relation :
  - `(0,1)` → zéro ou une fois
  - `(1,1)` → exactement une fois
  - `(0,n)` → zéro ou plusieurs fois
  - `(1,n)` → au moins une fois

### Les entités à modéliser

| Entité | Attributs attendus |
| --- | --- |
| **CANARD** | identifiant (auto), nom, type, état |
| **ETUDIANT** | num_carte (identifiant saisi), nom, prenom, email |
| **EMPRUNT** | (relation porteuse) date_pret, date_retour_prevue |

> **Point d'attention :** Un même canard ne peut être emprunté qu'une seule fois à la fois (`0,1`). Un étudiant peut avoir plusieurs emprunts successifs (`0,n`). La relation EMPRUNT porte les dates - elle devient une **table à part entière** dans le MLD.

### Du MCD au MLD

Le passage MCD → MLD suit des règles mécaniques :

1. Chaque **entité** devient une **table** avec sa clé primaire.
2. Une **relation binaire (1,n) / (0,1)** : la clé du côté `n` migre comme clé étrangère dans la table du côté `1`.
3. Une **relation porteuse d'attributs** (comme EMPRUNT ici) devient une **table associative** avec les clés étrangères des deux entités + ses propres attributs.

---

## 3. Spécifications Techniques

### A. Base de données

- Créez votre base et vos tables à partir de votre MLD dans un fichier `database.sql`.
- Déclarez explicitement les **clés primaires** et les **clés étrangères** (`FOREIGN KEY ... REFERENCES ...`).
- Utilisez des **types de données adaptés** : `VARCHAR`, `ENUM`, `DATE`, `INT`, etc.
- L'**intégrité référentielle** doit être respectée (on ne peut pas créer un emprunt avec un canard ou un étudiant inexistant).

**Exemple de bonne pratique pour la contrainte d'état :**

```sql
etat ENUM('Dans la mare', 'En vadrouille', 'En nettoyage') NOT NULL DEFAULT 'Dans la mare'
```

### B. Architecture PHP

Votre projet doit séparer clairement les responsabilités. Structure recommandée :

```text
canardotheque/
├── config/
│   └── db.php                  ← Connexion PDO (inclus avec require)
├── models/
│   ├── Canard.php              ← Requêtes SQL canards
│   ├── Etudiant.php            ← Requêtes SQL étudiants
│   └── Emprunt.php             ← Requêtes SQL emprunts + UPDATE statut
├── views/
│   ├── canards/liste.php
│   ├── canards/ajouter.php
│   ├── etudiants/liste.php
│   ├── etudiants/ajouter.php
│   └── emprunts/creer.php
├── controllers/
│   ├── CanardController.php
│   ├── EtudiantController.php
│   └── EmpruntController.php
├── index.php                   ← Point d'entrée
└── database.sql
```

Le CSS n'est pas évalué. Une page fonctionnelle et lisible suffit.

### C. PHP et PDO

- Toute interaction avec la base de données se fait **exclusivement via PDO**.
- Le fichier `config/db.php` est écrit **une seule fois** et inclus avec `require`.

```php
<?php
// config/db.php
$dsn = 'mysql:host=localhost;dbname=canardotheque;charset=utf8';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
    $pdo = new PDO($dsn, 'root', '', $options);
} catch (PDOException $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}
```

### D. Sécurité

| Risque | Ce qui est attendu |
| --- | --- |
| **Injection SQL** | Toutes les requêtes avec données utilisateur (`$_POST`, `$_GET`) doivent utiliser `prepare()` + `execute()` |
| **Faille XSS** | Toutes les données issues de la base affichées en HTML doivent passer par `htmlspecialchars()` |

---

## 4. Approche Méthodologique

Ne démarrez pas par le code. Voici l'ordre de travail à respecter :

1. **MCD** - Identifiez vos entités, attributs et relations. Annotez les cardinalités.
2. **MLD** - Traduisez le MCD en tables avec clés primaires et étrangères.
3. **`database.sql`** - Rédigez et testez votre script de création. Insérez le jeu de données.
4. **`config/db.php`** - Vérifiez que la connexion PDO fonctionne.
5. **CRUD Canards** - Listez les canards (SELECT), puis ajoutez-en un (INSERT via formulaire).
6. **CRUD Étudiants** - Même logique.
7. **Emprunts** - Formulaire d'emprunt → INSERT dans `emprunt` + UPDATE du statut du canard.
8. **Sécurité** - Auditez chaque requête (préparée ?) et chaque affichage (`htmlspecialchars()` ?).
9. **Dépôt GitHub** - Initialisez votre dépôt, commitez au fur et à mesure, poussez avant la fin de journée.

---

## 5. Rendu - Dépôt GitHub

**Le rendu se fait exclusivement via un dépôt GitHub public**, à soumettre avant la fin de journée.

### Ce que doit contenir le dépôt

```text
canardotheque/              ← Racine du dépôt
├── config/
│   └── db.php              ← Connexion PDO
├── models/
│   ├── Canard.php          ← Requêtes SQL liées aux canards (SELECT, INSERT...)
│   ├── Etudiant.php        ← Requêtes SQL liées aux étudiants
│   └── Emprunt.php         ← Requêtes SQL liées aux emprunts + UPDATE statut
├── views/
│   ├── canards/
│   │   ├── liste.php       ← Affichage HTML de la liste des canards
│   │   └── ajouter.php     ← Formulaire d'ajout
│   ├── etudiants/
│   │   ├── liste.php
│   │   └── ajouter.php
│   └── emprunts/
│       └── creer.php       ← Formulaire d'emprunt
├── controllers/
│   ├── CanardController.php
│   ├── EtudiantController.php
│   └── EmpruntController.php
├── index.php               ← Point d'entrée, routing minimal
├── database.sql            ← Obligatoire
├── mcd.png                 ← ou mcd.pdf - Obligatoire
└── README.md               ← Voir consignes ci-dessous
```

**Rôle de chaque couche :**

| Couche | Rôle | Contient |
| --- | --- | --- |
| **Model** | Accès aux données | Les requêtes PDO (SELECT, INSERT, UPDATE) |
| **View** | Affichage | Le HTML + `htmlspecialchars()` sur les données affichées |
| **Controller** | Logique | Réception de `$_POST`, appel du modèle, redirection vers la vue |

### Le fichier `README.md`

Votre dépôt doit contenir un `README.md` à la racine avec :

1. **Votre nom et prénom**
2. **Comment lancer le projet** : nom de la base à créer, comment importer `database.sql`, URL d'accès local
3. **Ce qui fonctionne** : listez les fonctionnalités implémentées
4. **Ce qui ne fonctionne pas** (le cas échéant) : soyez honnête, c'est apprécié

### Consignes Git

- Faites **plusieurs commits** au fil de votre travail - un seul commit final "tout en vrac" sera pénalisé.
- Le message de chaque commit doit être explicite : `Ajout liste canards`, `Règle métier emprunt`, etc.
- **N'incluez pas** vos identifiants de base de données dans `db.php` si ce ne sont pas les valeurs par défaut.

> **Heure limite de rendu :** fin de journée. Tout push après cette heure ne sera pas pris en compte.
