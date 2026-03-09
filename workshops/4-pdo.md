# Workshop PDO

> **Contrainte :** Utiliser PDO. Aidez-vous de la [documentation PDO sur PHP.net](https://www.php.net/manual/fr/book.pdo.php).

## Mise en place

Créer une base de données et exécuter ce code SQL, par exemple dans phpMyAdmin :

```sql
DROP TABLE IF EXISTS utilisateurs;

CREATE TABLE utilisateurs(
    id INT NOT NULL AUTO_INCREMENT,
    pseudo VARCHAR(30) NOT NULL,
    motDePasse VARCHAR(30) NOT NULL,
    statutAdmin BOOLEAN DEFAULT 0,
    PRIMARY KEY (id)
);

INSERT INTO utilisateurs(pseudo, motDePasse, statutAdmin) VALUES
    ('Gandalf', 'Maia', 1),
    ('Aragorn', 'Dunedain', 0),
    ('Legolas', 'Iluvatar', 0),
    ('Gimli', 'Gloin', 0),
    ('Frodo', 'ring', 0);
```

## Exercices

### 1. Connexion PDO

- Ouvrir une connexion à la base de données. Vous aurez besoin au préalable de créer votre chaîne de connexion.
- Que se passe-t-il si la connexion échoue (le serveur ne répond pas, ou l'identification échoue par exemple) ?
- Gérer proprement ce cas d'erreur.

### 2. Première requête avec `PDO::query`

Écrire une requête SQL permettant de vérifier si l'utilisateur `Gandalf` est présent dans la table `utilisateurs` et la mettre dans une variable PHP. Exécuter la requête à l'aide de la méthode `PDO::query`.

- Vérifier que la requête s'est bien passée, sinon afficher un message d'erreur et arrêter le programme.
- Si la requête a bien fonctionné, afficher si l'utilisateur a été trouvé ou non dans la base.

### 3. Récupérer un enregistrement sous 3 formes

Sur le même modèle, écrire une requête permettant de récupérer tous les champs de l'utilisateur `Gandalf`. Afficher le `statutAdmin` de cette ligne de 3 façons différentes, en récupérant le contenu de l'enregistrement sous forme :

- D'un **tableau simple** (index)
- D'un **dictionnaire** (tableau associatif)
- D'un **objet anonyme**

> **Remarque :** on pourra utiliser des commentaires de code pour n'exécuter qu'une seule méthode à la fois, sans quoi plusieurs `fetch()` successifs vont modifier le comportement.

### 4. Récupérer plusieurs enregistrements

Écrire une requête permettant de récupérer tous les pseudos de la table `utilisateurs`. Faire une boucle `foreach` pour les afficher.

### 5. Injections SQL

Créer une requête permettant de gérer la connexion d'un utilisateur au site, en vérifiant son login et son mot de passe, à partir d'un pseudo et d'un mot de passe contenus dans les variables PHP `$pseudo` et `$mdp`.

- Nous allons maintenant simuler la saisie de données inconnues. On peut virtuellement avoir n'importe quoi dans `$pseudo` et `$mdp`. Quels sont les risques à prendre en compte dans la construction de la requête ?
- Imaginez des valeurs de pseudo pouvant poser problème.
- Faites une injection SQL dans la requête de connexion.

### 6. Passage de paramètres entre pages PHP

Pour comprendre différentes méthodes de transfert de données entre deux pages PHP, réalisez les étapes suivantes :

1. Créez une première page `source.php` incluant une variable `$param = 'SECRET';`.
2. Identifiez 4 méthodes de passage de paramètre à une autre page (`destination.php`) : **GET**, **POST**, **SESSION**, **COOKIE**.
3. Pour chaque méthode, créez un lien ou un formulaire permettant de transmettre `$param` à `destination.php`.
4. Dans `destination.php`, récupérez et affichez la valeur transmise pour vérifier que le paramètre est bien reçu.
5. Testez avec des caractères spéciaux et des valeurs contenant des espaces ou des symboles.
6. Discutez des différences et des cas où certaines méthodes sont préférables (ex. : GET pour URLs, POST pour formulaires, SESSION pour données persistantes côté serveur, COOKIE pour stocker côté client).

### 7. Requêtes préparées

- Comment gérer le problème des injections SQL ?
- Quel est l'intérêt d'une requête préparée ?
- À l'aide de `PDOStatement::prepare`, créer une requête préparée permettant de retourner un utilisateur en fonction de son pseudo.

Il existe deux moyens de lier les paramètres aux requêtes préparées : avec les méthodes `PDOStatement::bindParam` et `PDOStatement::bindValue`.

- Quelle est la différence entre les deux méthodes ?
- Écrire un code mettant en évidence cette différence de comportement.
