# Mini-Projet : La Guilde des Aventuriers

## Contexte du Projet

L'association étudiante **"La Guilde des Aventuriers"** organise des campagnes de jeu de rôle sur table chaque semaine. Avec une trentaine de membres actifs, les décisions collectives (choix du prochain scénario, horaires de session, règles maison à adopter) se prenaient jusqu'ici dans un fil Discord devenu ingérable.

Le grand maître de guilde a besoin d'une application web intranet simple pour créer des **sondages**, permettre aux membres de **voter**, et consulter les **résultats sous forme de graphique**.

> Lisez l'intégralité du cahier des charges, réalisez votre MCD sur papier, puis seulement commencez à coder.

---

## 1. Spécifications Fonctionnelles

### A. Gestion des membres - Les Aventuriers

- Consulter la **liste complète** des membres (pseudo, classe, email).
- **Inscrire** un nouvel aventurier en renseignant :
  - Son pseudo *(identifiant unique, saisi manuellement)*
  - Sa classe parmi : `Guerrier`, `Mage`, `Rôdeur`, `Clerc`, `Barde`
  - Son adresse email

### B. Gestion des sondages - Les Quêtes à Décider

- Consulter la **liste de tous les sondages** avec leur statut, affichés sous forme de **cartes**.
- **Créer** un nouveau sondage en renseignant :
  - Un titre (ex : *"Quel scénario pour la session du 15 ?"*)
  - Une description optionnelle
  - Une date de clôture
  - Au moins **deux options** de réponse - les champs sont ajoutés **dynamiquement** via un bouton "Ajouter une option" (voir section JavaScript)
- **Clôturer** un sondage manuellement depuis la liste, avec une **demande de confirmation** avant l'action.
- Les statuts possibles d'un sondage sont **strictement limités** à :
  - `Ouvert` *(les membres peuvent voter)*
  - `Clôturé` *(plus aucun vote accepté, résultats visibles)*

### C. Gestion des votes - Le Conseil

- Sur la page d'un sondage `Ouvert`, un aventurier choisit son pseudo dans une liste déroulante et sélectionne **une option**.
- **Règle métier obligatoire :** un aventurier ne peut voter **qu'une seule fois par sondage**. Toute tentative de second vote doit être rejetée avec un message explicite.
- Sur la page d'un sondage `Clôturé` (ou après son propre vote), l'aventurier voit les **résultats** : nombre de votes par option, affichés sous forme de **graphique en barres** (Chart.js).

---

## 2. Modélisation - MCD

**C'est la première étape, obligatoire avant tout code.**

### Ce qu'on attend

Vous devez produire un **Modèle Conceptuel de Données (MCD)** complet représentant les entités du système et leurs relations. Vous pouvez le réaliser sur papier, avec [Looping](https://www.looping-mcd.fr/), ou avec draw.io.

### Rappel de notation

Un MCD se compose d'**entités** (rectangles), de **relations** (ellipses ou losanges), et de **cardinalités** (annotations sur les pattes).

```text
AVENTURIER --(0,n)-- VOTER --(0,n)-- OPTION --(1,1)-- SONDAGE
```

- Une entité possède des **attributs** dont l'un est l'**identifiant** (souligné).
- Les **cardinalités** expriment combien de fois une entité peut participer à une relation.

### Les entités à modéliser

| Entité | Attributs attendus |
| --- | --- |
| **AVENTURIER** | pseudo (identifiant saisi), classe, email |
| **SONDAGE** | identifiant (auto), titre, description, date_cloture, statut |
| **OPTION** | identifiant (auto), libelle |
| **VOTE** | (relation porteuse) date du vote |

> **Point d'attention :** Un aventurier peut voter pour des options de sondages différents (`0,n`). Une option peut recevoir les votes de plusieurs aventuriers (`0,n`). La relation VOTER devient donc une **table associative**. La contrainte "un seul vote par sondage" ne peut pas s'exprimer directement dans le MCD - elle sera portée par la base de données et vérifiée côté PHP (voir section Technique).

### Du MCD au MLD

Le passage MCD → MLD suit des règles mécaniques :

1. Chaque **entité** devient une **table** avec sa clé primaire.
2. Une **relation (1,n) / (1,1)** entre SONDAGE et OPTION : la clé de SONDAGE migre comme clé étrangère dans OPTION.
3. La **relation VOTER** (porteuse de la date) devient une **table associative** `vote` avec `pseudo_aventurier` et `id_option` comme clés étrangères, et leur combinaison comme clé primaire composite.

---

## 3. Spécifications Techniques

### A. Base de données

- Créez votre base et vos tables à partir de votre MLD dans un fichier `database.sql`.
- Déclarez explicitement les **clés primaires**, les **clés étrangères** et les **contraintes d'unicité**.
- Utilisez des **types de données adaptés** : `VARCHAR`, `ENUM`, `DATE`, `DATETIME`, `INT`, etc.

**Exemple de bonne pratique pour la contrainte métier :**

La règle "un seul vote par sondage par aventurier" ne peut pas se réduire à une clé primaire sur `(pseudo, id_option)` - un aventurier ne devrait pas pouvoir voter pour deux options du même sondage. Il faut la vérifier **côté PHP** avant d'insérer, avec une requête `SELECT COUNT(*)`.

```sql
-- Table associative vote
CREATE TABLE vote (
    pseudo_aventurier VARCHAR(50) NOT NULL,
    id_option         INT         NOT NULL,
    date_vote         DATETIME    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (pseudo_aventurier, id_option),
    FOREIGN KEY (pseudo_aventurier) REFERENCES aventurier(pseudo),
    FOREIGN KEY (id_option)         REFERENCES option(id)
);
```

### B. Architecture PHP

Votre projet doit séparer clairement les responsabilités. Structure recommandée :

```text
guilde/
├── config/
│   └── db.php                      ← Connexion PDO
├── models/
│   ├── Aventurier.php              ← Requêtes SQL membres
│   ├── Sondage.php                 ← Requêtes SQL sondages + options
│   └── Vote.php                    ← Requêtes SQL votes + vérification doublon
├── views/
│   ├── layout/
│   │   ├── header.php              ← <head>, <nav>, ouverture de <main>
│   │   └── footer.php              ← fermeture de <main>, <footer>
│   ├── aventuriers/liste.php
│   ├── aventuriers/ajouter.php
│   ├── sondages/liste.php
│   ├── sondages/creer.php
│   ├── sondages/voter.php
│   └── sondages/resultats.php
├── controllers/
│   ├── AventurierController.php
│   ├── SondageController.php
│   └── VoteController.php
├── public/
│   ├── style.css                   ← Feuille de style unique
│   └── app.js                      ← Scripts JS (formulaire dynamique, confirmation)
├── index.php                       ← Point d'entrée unique
└── database.sql
```

### C. PHP et PDO

- Toute interaction avec la base de données se fait **exclusivement via PDO**.
- Le fichier `config/db.php` est écrit **une seule fois** et inclus avec `require`.

```php
<?php
// config/db.php
$dsn = 'mysql:host=localhost;dbname=guilde;charset=utf8';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
    $pdo = new PDO($dsn, 'root', '', $options);
} catch (PDOException $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}
```

### D. CSS

**Un seul fichier** `public/style.css` est partagé par toutes les pages via le layout `header.php`.

Contraintes attendues :

- La **navigation** est présente et lisible sur toutes les pages (liens vers : Accueil, Sondages, Aventuriers).
- La liste des sondages est affichée sous forme de **cartes** (une card par sondage, avec titre, statut et date de clôture). Les cartes `Ouvert` et `Clôturé` doivent se distinguer visuellement (couleur, badge, ou autre indicateur).
- Les formulaires sont lisibles et aérés (labels alignés, champs pleine largeur, bouton de soumission mis en valeur).
- Le site doit être **présentable** : marges, couleurs cohérentes, typographie lisible. Pas besoin d'être spectaculaire.

### E. JavaScript

Trois comportements sont attendus, tous dans `public/app.js`.

#### 1. Formulaire de création dynamique

Le formulaire de création d'un sondage doit permettre d'ajouter ou de supprimer des champs d'option **sans recharger la page**.

- Un bouton **"+ Ajouter une option"** insère un nouveau champ `<input>` dans le formulaire.
- Chaque option (à partir de la troisième) dispose d'un bouton **"Supprimer"** qui retire le champ correspondant. Les deux premières options sont permanentes (on ne peut pas descendre en dessous de deux).
- Les champs doivent être nommés `options[]` pour que PHP les reçoive comme un tableau dans `$_POST`.

```javascript
// Exemple de logique attendue - à implémenter à votre manière
document.getElementById('btn-ajouter-option').addEventListener('click', () => {
    // créer un <div> contenant un <input name="options[]"> et un bouton supprimer
    // l'ajouter au conteneur
    // afficher/masquer les boutons supprimer selon le nombre de champs
});
```

#### 2. Confirmation avant clôture

Avant de soumettre l'action qui clôture un sondage, une confirmation doit être demandée à l'utilisateur. Un `confirm()` natif est suffisant, une modale CSS est appréciée.

```javascript
document.querySelectorAll('.btn-cloturer').forEach(btn => {
    btn.addEventListener('click', (e) => {
        if (!confirm('Clôturer ce sondage ? Cette action est irréversible.')) {
            e.preventDefault();
        }
    });
});
```

#### 3. Graphique des résultats (Chart.js)

La page de résultats doit afficher un **graphique en barres** représentant le nombre de votes par option.

Vous utiliserez **[Chart.js](https://www.chartjs.org/)** (CDN, pas besoin d'installation) :

```html
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
```

Les données sont **injectées par PHP** dans la vue sous forme de JSON, puis lues par JavaScript :

```php
<?php
// Dans resultats.php - le contrôleur a passé $resultats à la vue
$labels  = array_column($resultats, 'libelle');
$valeurs = array_column($resultats, 'nb_votes');
?>
<canvas id="graphique"></canvas>
<script>
    const labels  = <?php echo json_encode($labels); ?>;
    const valeurs = <?php echo json_encode($valeurs); ?>;

    new Chart(document.getElementById('graphique'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{ label: 'Votes', data: valeurs }]
        },
        options: {
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });
</script>
```

> PHP génère du HTML contenant des données JSON figées au moment du rendu. JavaScript les lit au chargement. Il n'y a pas de requête réseau côté client - c'est différent d'une API ou d'un `fetch()`.

### F. Sécurité

| Risque | Ce qui est attendu |
| --- | --- |
| **Injection SQL** | Toutes les requêtes avec données utilisateur doivent utiliser `prepare()` + `execute()` |
| **Faille XSS** | Toutes les données issues de la base affichées en HTML doivent passer par `htmlspecialchars()` |
| **Double vote** | Vérifier l'existence d'un vote pour le couple `(pseudo, id_sondage)` **avant** l'INSERT |

---

## 4. Approche Méthodologique

Ne démarrez pas par le code. Voici l'ordre de travail à respecter :

1. **MCD** - Identifiez vos entités, attributs, relations et cardinalités.
2. **MLD** - Traduisez en tables avec clés primaires, étrangères et contraintes.
3. **`database.sql`** - Rédigez et testez votre script. Insérez un jeu de données de test (2-3 aventuriers, 1-2 sondages avec options).
4. **`config/db.php`** - Vérifiez que la connexion PDO fonctionne.
5. **Layout** - Créez `header.php` et `footer.php` avec la navigation et le lien vers `style.css`. Posez les bases du CSS.
6. **CRUD Aventuriers** - Liste + ajout.
7. **CRUD Sondages** - Liste en cartes + création avec le formulaire dynamique JS + clôture avec confirmation.
8. **Vote** - Formulaire de vote avec vérification du doublon + INSERT.
9. **Résultats** - Requête d'agrégation SQL + graphique Chart.js.
10. **Sécurité** - Auditez chaque requête (préparée ?) et chaque affichage (`htmlspecialchars()` ?).
11. **Dépôt GitHub** - Initialisez votre dépôt, commitez au fur et à mesure, poussez avant la fin de journée.
