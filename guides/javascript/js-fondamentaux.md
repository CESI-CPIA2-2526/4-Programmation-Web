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

# JavaScript — Fondamentaux

## Syntaxe, DOM, événements, fetch

---

# JavaScript, c'est quoi ?

JavaScript est un langage **exécuté côté client** : le code s'exécute directement dans le navigateur, sans passer par le serveur.

```text
Navigateur  ──(requête HTTP)──▶  Serveur
     │        ◀──(HTML + JS)──
     │
  JS s'exécute
  dans le navigateur
     │
  Modifie la page,
  réagit aux clics,
  appelle des APIs
```

- Le serveur envoie le fichier `.js` au navigateur
- JS peut **modifier la page** sans rechargement
- Extension des fichiers : `.js`

---

# Syntaxe de base

```js
// Commentaire sur une ligne
/* Commentaire
   sur plusieurs lignes */

// Affichage dans la console
console.log("Bonjour le monde !");

// Déclaration de variables
let age = 22;          // modifiable
const nom = "Alice";   // constante — non réassignable

// Constante calculée
const TVA = 1.20;

// Inclusion dans une page HTML
// <script src="script.js"></script>
// ou en bas de <body> : <script> ... </script>
```

> `const` par défaut, `let` si la variable doit changer. Ne jamais utiliser `var`.

---

# Variables et types

```js
const prenom  = "Alice";      // string
const age     = 22;           // number
const moyenne = 14.75;        // number (pas de float séparé)
const estActif = true;        // boolean
const inconnu  = null;        // null — absence intentionnelle de valeur
let   resultat;                // undefined — non initialisé
const notes   = [12, 15, 18]; // array
const user    = { nom: "Alice", age: 22 }; // object
```

| Type | Exemple | `typeof` |
|------|---------|----------|
| string | `"Alice"` | `"string"` |
| number | `22` / `14.75` | `"number"` |
| boolean | `true` | `"boolean"` |
| null | `null` | `"object"` ⚠️ |
| undefined | `undefined` | `"undefined"` |
| array/object | `[]` / `{}` | `"object"` |

JS est **dynamiquement typé** : le type s'adapte à la valeur assignée.

---

# Structures de contrôle

<div class="columns">
<div>

**Conditions**

```js
const note = 14;

if (note >= 16) {
    console.log("Très bien");
} else if (note >= 14) {
    console.log("Bien");
} else if (note >= 10) {
    console.log("Passable");
} else {
    console.log("Insuffisant");
}
```

</div>
<div>

**Boucles**

```js
// forEach sur un tableau
const noms = ["Alice", "Bob", "Clara"];
noms.forEach(nom => {
    console.log(nom);
});

// for...of
for (const nom of noms) {
    console.log(nom);
}

// for classique
for (let i = 1; i <= 5; i++) {
    console.log(i);
}
```

</div>
</div>

---

# Fonctions

<div class="columns">
<div>

**Déclaration classique**

```js
function calculerTTC(ht, tva = 20) {
    return ht * (1 + tva / 100);
}

console.log(calculerTTC(100));      // 120
console.log(calculerTTC(100, 5.5)); // 105.5
```

Hoistée : utilisable avant sa déclaration dans le fichier.

</div>
<div>

**Fonction fléchée**

```js
// Syntaxe complète
const calculerTTC = (ht, tva = 20) => {
    return ht * (1 + tva / 100);
};

// Retour implicite (1 expression)
const double = n => n * 2;

const saluer = nom =>
    `Bonjour ${nom} !`;

console.log(double(5));       // 10
console.log(saluer("Alice")); // Bonjour Alice !
```

</div>
</div>

> Les **fonctions fléchées** sont la syntaxe moderne, privilégiée pour les callbacks.

---

# Les chaînes : template literals vs concaténation

<div class="columns">
<div>

**Concaténation avec `+`**

```js
const nom = "Alice";
const age = 22;

// Opérateur +
const phrase = "Prénom : " + nom
             + ", Âge : " + age + " ans";

// Lourd à lire avec plusieurs variables
const html = "<li class=\"user\">"
           + nom + "</li>";
```

Difficile à lire dès qu'il y a plusieurs variables.

</div>
<div>

**Template literals avec `` ` ``**

```js
const nom = "Alice";
const age = 22;

// Interpolation avec ${}
const phrase = `Prénom : ${nom}, Âge : ${age} ans`;

// Multi-lignes natif
const html = `
  <li class="user">
    ${nom} (${age} ans)
  </li>
`;
```

Utiliser par défaut dès qu'une variable est présente.

</div>
</div>

---

# Fonctions de chaînes essentielles

| Méthode | Rôle | Exemple |
|---------|------|---------|
| `.length` | Longueur | `"été".length` → `3` |
| `.toUpperCase()` | Majuscules | `"été".toUpperCase()` → `"ÉTÉ"` |
| `.toLowerCase()` | Minuscules | `"ÉTÉ".toLowerCase()` → `"été"` |
| `.slice(début, fin)` | Sous-chaîne | `"Bonjour".slice(0, 3)` → `"Bon"` |
| `.indexOf(cherche)` | Position | `"Bonjour".indexOf("jour")` → `3` |
| `.includes(cherche)` | Contient ? | `"Bonjour".includes("jour")` → `true` |
| `.replace(old, new)` | Remplacement | `"le monde".replace(" ", "-")` → `"le-monde"` |
| `.trim()` | Supprime espaces | `"  hello  ".trim()` → `"hello"` |
| `.split(sep)` | Découpe en tableau | `"a,b,c".split(",")` → `["a","b","c"]` |
| `.join(sep)` | Tableau → chaîne | `["a","b"].join("-")` → `"a-b"` |

---

# Les tableaux et leurs méthodes

```js
const notes = [12, 15, 18, 10, 14];

// Transformer → map (retourne un nouveau tableau)
const doubles = notes.map(n => n * 2);         // [24, 30, 36, 20, 28]

// Filtrer → filter (retourne un sous-tableau)
const admis = notes.filter(n => n >= 10);      // [12, 15, 18, 10, 14]

// Trouver → find (retourne le premier élément)
const premier = notes.find(n => n > 13);       // 15

// Réduire → reduce (retourne une valeur)
const somme = notes.reduce((acc, n) => acc + n, 0); // 69

// Ajouter / supprimer
notes.push(20);       // ajoute en fin
notes.pop();          // retire le dernier
notes.unshift(8);     // ajoute en début
notes.shift();        // retire le premier
```

> `map`, `filter`, `find`, `reduce` ne modifient **pas** le tableau d'origine.

---

# Le DOM

Le **DOM** (Document Object Model) est la représentation de la page HTML en objets JS manipulables.

<div class="columns">
<div>

**Sélectionner des éléments**

```js
// Un seul élément (le premier trouvé)
const titre = document.querySelector("h1");
const btn   = document.querySelector("#mon-btn");
const card  = document.querySelector(".card");

// Plusieurs éléments
const items = document.querySelectorAll("li");
items.forEach(item => {
    console.log(item.textContent);
});
```

</div>
<div>

**Modifier des éléments**

```js
const titre = document.querySelector("h1");

// Modifier le texte (sécurisé)
titre.textContent = "Nouveau titre";

// Modifier le HTML (attention XSS !)
titre.innerHTML = "<em>Titre</em>";

// Modifier le style
titre.style.color = "red";

// Modifier les classes
titre.classList.add("actif");
titre.classList.remove("caché");
titre.classList.toggle("sélectionné");
```

</div>
</div>

> Toujours préférer `textContent` à `innerHTML` pour insérer du texte brut.

---

# Événements

```js
const btn = document.querySelector("#mon-btn");

// Écouter un clic
btn.addEventListener("click", () => {
    console.log("Bouton cliqué !");
});

// Accéder à l'événement
btn.addEventListener("click", (event) => {
    event.preventDefault(); // bloque le comportement par défaut
    console.log("Cliqué sur :", event.target);
});

// Écouter la soumission d'un formulaire
const form = document.querySelector("form");
form.addEventListener("submit", (event) => {
    event.preventDefault(); // empêche le rechargement de la page

    const nom = document.querySelector("#nom").value.trim();
    if (!nom) {
        alert("Le nom est requis.");
        return;
    }
    console.log("Formulaire soumis avec :", nom);
});
```

---

# Fetch API — requête HTTP

`fetch` permet d'appeler une API ou un serveur **sans rechargement de page**.

```js
// Syntaxe avec async / await (recommandée)
async function chargerUtilisateurs() {
    try {
        const reponse = await fetch("https://api.exemple.com/utilisateurs");

        if (!reponse.ok) {
            throw new Error(`Erreur HTTP : ${reponse.status}`);
        }

        const utilisateurs = await reponse.json();
        console.log(utilisateurs);

    } catch (erreur) {
        console.error("Impossible de charger les données :", erreur);
    }
}

chargerUtilisateurs();
```

> `await` suspend l'exécution jusqu'à la réponse, sans bloquer le reste de la page.
> Toujours entourer d'un `try / catch` pour gérer les erreurs réseau.

---

# Le piège : `==` vs `===`

`==` compare les **valeurs** avec conversion de type.
`===` compare les **valeurs ET les types** — à préférer.

```js
console.log(0   == "0");      // true  — piège !
console.log(0   === "0");     // false — correct

console.log(1   == true);     // true
console.log(1   === true);    // false

console.log("" == false);     // true
console.log("" === false);    // false

console.log(null == undefined);  // true
console.log(null === undefined); // false
```

> **Règle :** utiliser `===` par défaut. Ne jamais utiliser `==` sauf cas très spécifique.

---

# Débogage

<div class="columns">
<div>

**`console.log()`** — valeur brute

```js
const user = { nom: "Alice", age: 22 };

console.log(user);
// { nom: 'Alice', age: 22 }

console.log("user →", user);
// user → { nom: 'Alice', age: 22 }
```

**`console.table()`** — tableau lisible

```js
const notes = [
  { nom: "Alice", note: 18 },
  { nom: "Bob",   note: 14 },
];

console.table(notes);
```

</div>
<div>

**`console.error()` / `console.warn()`**

```js
console.warn("Attention : valeur nulle");
console.error("Erreur critique !");
```

**`debugger`** — point d'arrêt

```js
function calculer(a, b) {
    debugger; // pause ici dans DevTools
    return a + b;
}
```

Ouvrir les **DevTools** (F12) → onglet **Console** pour voir les logs, onglet **Sources** pour les points d'arrêt.

</div>
</div>

---

# À retenir

1. JavaScript s'exécute **côté client** — directement dans le navigateur
2. `const` par défaut, `let` si la variable change, **jamais `var`**
3. Utiliser les **template literals** `` `${variable}` `` plutôt que `+`
4. `===` (identique) plutôt que `==` (égal avec coercition)
5. `querySelector` + `addEventListener` pour interagir avec la page
6. Toujours utiliser `textContent` plutôt que `innerHTML` pour du texte brut
7. `async / await` + `try / catch` pour les appels `fetch`

**La règle d'or :**
> Ne jamais insérer de données non maîtrisées dans `innerHTML` — risque XSS identique à PHP.

---

<!-- _class: title -->

# Questions ?
