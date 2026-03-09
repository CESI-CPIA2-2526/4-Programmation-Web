# Workshop 4 - PDO

**Type :** Workshop — **Thème :** PDO, injections SQL, requêtes préparées, sessions et cookies

**Votre mission :** Prendre en main PDO pour connecter une application PHP à une base de données, sécuriser les requêtes contre les injections SQL, puis explorer les différents mécanismes de passage de données entre pages.

**Contrainte :** Utiliser PDO pour toutes les interactions avec la base de données. Appuyez-vous sur la [documentation PDO sur php.net](https://www.php.net/manual/en/book.pdo.php).

**À produire :**

| Exercice | Ce qu'on attend |
|----------|-----------------|
| 1 — Connexion | Connexion PDO fonctionnelle avec gestion d'erreur |
| 2 — Requêtes | Lecture de données avec les 3 modes de récupération |
| 3 — Injection SQL | Mise en évidence d'une injection et correction |
| 4 — Passage de paramètres | `source.php` et `destination.php` avec 4 méthodes |
| 5 — Requêtes préparées | Requête préparée + comparaison `bindParam` / `bindValue` |

---

## Mise en place : Base de données

Créez une base de données et exécutez le script SQL suivant (par exemple dans phpMyAdmin) :

```sql
DROP TABLE IF EXISTS utilisateurs;

CREATE TABLE utilisateurs (
    id          INT          NOT NULL AUTO_INCREMENT,
    pseudo      VARCHAR(30)  NOT NULL,
    motDePasse  VARCHAR(30)  NOT NULL,
    statutAdmin BOOLEAN      DEFAULT 0,
    PRIMARY KEY (id)
);

INSERT INTO utilisateurs (pseudo, motDePasse, statutAdmin) VALUES
    ('Gandalf', 'Maia',     1),
    ('Aragorn', 'Dunedain', 0),
    ('Legolas', 'Iluvatar', 0),
    ('Gimli',   'Gloin',    0),
    ('Frodo',   'ring',     0);
```

---

## Exercice 1 : Connexion PDO

Ouvrir une connexion à la base de données et gérer proprement les erreurs.

### Étape 1 : Créer la chaîne de connexion

Construisez votre DSN (Data Source Name) et instanciez un objet `PDO` avec vos identifiants.

### Étape 2 : Tester la connexion

Que se passe-t-il si la connexion échoue (serveur injoignable, mauvais identifiants...) ?

### Étape 3 : Gérer l'erreur proprement

Interceptez l'exception et affichez un message d'erreur clair à l'utilisateur sans exposer les détails techniques.

---

## Exercice 2 : Exécuter des requêtes et récupérer des données

Interroger la base et récupérer des résultats sous différentes formes.

### Étape 1 : Vérifier la présence d'un utilisateur

Écrivez une requête SQL vérifiant si l'utilisateur `Gandalf` est présent dans la table, en utilisant `PDO::query`. Vérifiez que la requête s'est bien exécutée, affichez un message d'erreur sinon. Affichez ensuite si l'utilisateur a été trouvé ou non.

### Étape 2 : Récupérer tous les champs d'un utilisateur

Sur le même modèle, récupérez tous les champs de l'utilisateur `Gandalf`. Affichez son `statutAdmin` de **3 façons différentes** :

| Mode | Méthode PDO |
|------|-------------|
| Tableau indexé | `PDO::FETCH_NUM` |
| Tableau associatif | `PDO::FETCH_ASSOC` |
| Objet anonyme | `PDO::FETCH_OBJ` |

> **Remarque :** utilisez des commentaires pour n'activer qu'une seule méthode à la fois. Plusieurs `fetch()` successifs sur le même résultat modifient le comportement.

### Étape 3 : Récupérer tous les pseudos

Écrivez une requête récupérant tous les pseudos de la table. Utilisez une boucle `foreach` pour les afficher.

---

## Exercice 3 : Authentification et injection SQL

Construire une requête de connexion, puis comprendre et reproduire une injection SQL.

### Étape 1 : Requête de connexion

Créez une requête vérifiant le login et le mot de passe d'un utilisateur à partir des variables PHP `$pseudo` et `$mdp`.

### Étape 2 : Simuler des saisies inconnues

`$pseudo` et `$mdp` peuvent contenir n'importe quoi. Quels sont les risques dans la construction de la requête ?

- Imaginez des valeurs de `$pseudo` qui pourraient poser problème.
- Faites une injection SQL dans la requête de connexion pour valider votre hypothèse.

### Étape 3 : Identifier la solution

Comment faut-il gérer ce problème ? Quel est l'intérêt des requêtes préparées ?

---

## Exercice 4 : Passage de paramètres entre pages

Comprendre les 4 méthodes de transmission de données entre pages PHP.

### Étape 1 : Créer `source.php`

Créez une page `source.php` contenant une variable `$param = 'SECRET';`.

### Étape 2 : Implémenter les 4 méthodes

Pour chaque méthode, créez un lien ou un formulaire transmettant `$param` à `destination.php` :

| Méthode | Mécanisme |
|---------|-----------|
| GET | Paramètre dans l'URL (`?param=...`) |
| POST | Formulaire avec `method="post"` |
| SESSION | Stockage côté serveur avec `$_SESSION` |
| COOKIE | Stockage côté client avec `setcookie()` |

### Étape 3 : Créer `destination.php`

Récupérez et affichez la valeur transmise pour chaque méthode. Testez avec des caractères spéciaux, des espaces et des symboles.

### Étape 4 : Analyse

Discutez des différences entre les méthodes et des cas où chacune est préférable :

| Méthode | Cas d'usage typique |
|---------|---------------------|
| GET | Liens partageables, filtres, pagination |
| POST | Formulaires, données sensibles |
| SESSION | Données persistantes côté serveur (panier, utilisateur connecté) |
| COOKIE | Préférences utilisateur, connexion "se souvenir de moi" |

---

## Exercice 5 : Requêtes préparées

Sécuriser les requêtes avec `PDOStatement::prepare` et comprendre la différence entre `bindParam` et `bindValue`.

### Étape 1 : Créer une requête préparée

À l'aide de `PDOStatement::prepare`, créez une requête préparée retournant un utilisateur en fonction de son pseudo.

### Étape 2 : Comparer `bindParam` et `bindValue`

Il existe deux méthodes pour lier des paramètres à une requête préparée :

| Méthode | Comportement |
|---------|-------------|
| `bindParam()` | Lie la variable **par référence** — la valeur est lue au moment de l'exécution |
| `bindValue()` | Lie la valeur **par copie** — la valeur est capturée au moment de la liaison |

Écrivez un code mettant en évidence cette différence de comportement (par exemple en modifiant la variable entre la liaison et l'exécution).

---

## Critères de validation

| Critère | Description |
|---------|-------------|
| Fonctionnel | Le code fonctionne sans erreur et les données s'affichent correctement |
| Sécurité | Les requêtes utilisent des requêtes préparées, les erreurs ne fuient pas d'informations |
| Clarté | Code lisible et structuré |
| Compréhension | Les questions ouvertes (injection, bindParam/bindValue) sont répondues en commentaire |
