# Workshop 2 - PHP

---

## Exercice 1 : Televersement securise de fichiers

### Objectif

Mettre en place un systeme de televersement de fichiers avec validation et securisation.

### Etape 1 : Creer le formulaire HTML

Creer un fichier `upload.html` avec les specifications suivantes :

| Element | Description |
|---------|-------------|
| Type de fichier | PDF uniquement |
| Taille maximale | 2 Mo |
| Action | Bouton "Televerser" |

### Etape 2 : Creer le script PHP

Creer un fichier `upload.php` qui effectue les validations suivantes :

| Validation | Description |
|------------|-------------|
| Presence | Verifier qu'un fichier a ete televerse |
| Type MIME | Verifier que le fichier est bien un PDF (`application/pdf`) |
| Taille | Verifier que la taille ne depasse pas 2 Mo |

**En cas de succes :**
- Deplacer le fichier dans un repertoire `uploads/`
- Afficher un message de confirmation

**En cas d'erreur :**
- Afficher des messages clairs et explicites

### Etape 3 : Securiser l'affichage

- Utiliser `htmlspecialchars()` pour afficher les noms de fichiers
- Tester avec des noms contenant des caracteres speciaux

**Exemple de test :**

```
rapport<1>.pdf
fichier"test".pdf
document'special.pdf
```

---

## Exercice 2 : Pagination dynamique

### Objectif

Creer un systeme de pagination pour afficher une liste d'entreprises partenaires.

### Etape 1 : Creer le tableau de donnees

Creer un fichier `pagination.php` contenant un tableau de 50 entreprises avec les champs suivants :

| Champ | Description |
|-------|-------------|
| nom | Nom de l'entreprise |
| secteur | Secteur d'activite |
| ville | Ville du siege |

**Exemple de structure :**

```php
$entreprises = [
    ['nom' => 'TechCorp', 'secteur' => 'Technologie', 'ville' => 'Paris'],
    ['nom' => 'FinSoft', 'secteur' => 'Finance', 'ville' => 'Londres'],
    // Ajoutez d'autres entreprises ici
];
```

**Astuce :** Vous pouvez utiliser une IA generative pour generer rapidement un tableau de 50 entreprises fictives avec nom, secteur et ville.

### Etape 2 : Implementer la pagination

| Specification | Details |
|---------------|---------|
| Nombre par page | 10 entreprises |
| Parametre GET | `$_GET['page']` pour identifier la page actuelle |
| Fonction PHP | Utiliser `array_slice()` pour decouper le tableau |

### Etape 3 : Ajouter la navigation

Creer des boutons de navigation :

| Bouton | Action |
|--------|--------|
| Precedent | Lien vers `?page=N-1` |
| Suivant | Lien vers `?page=N+1` |

**Verifications a effectuer :**
- La page demandee existe
- Les boutons sont desactives aux extremites (page 1 et derniere page)

### Etape 4 : Securiser les parametres GET

| Securite | Implementation |
|----------|----------------|
| Validation du type | Verifier que `$_GET['page']` est un entier positif |
| Gestion des limites | Rediriger vers la page 1 si parametre invalide |
| Pages inexistantes | Afficher un message d'erreur ou rediriger |

---

## Exercice 3 : Validation et securite des donnees

### Objectif

Creer une fonction reutilisable pour valider et securiser les entrees utilisateur.

### Etape 1 : Creer la fonction validateInput

La fonction doit :

| Fonctionnalite | Description |
|----------------|-------------|
| Validation regex | Valider les champs texte (ex: nom d'entreprise) avec des expressions regulieres |
| Echappement | Utiliser `htmlspecialchars()` pour echapper les caracteres speciaux |

**Signature suggeree :**

```php
function validateInput(string $input, string $pattern = ''): string|false {
    // Votre implementation
}
```

### Etape 2 : Appliquer la fonction

Integrer `validateInput()` dans les fichiers precedents :

| Fichier | Application |
|---------|-------------|
| `upload.php` | Valider le nom du fichier televerse |
| `pagination.php` | Valider le parametre `$_GET['page']` |

---

## Criteres de validation

| Critere | Description |
|---------|-------------|
| Fonctionnel | Le code fonctionne sans erreur |
| Securite | Les donnees sont validees et echappees |
| Lisibilite | Code commente et bien structure |
| Reutilisabilite | Fonctions modulaires et reutilisables |
