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
    background-color: #2d2d2d;
    padding: 20px;
    border-radius: 8px;
    font-size: 18px;
  }

  pre code {
    background-color: transparent;
    color: #f8f8f2;
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

# Titre du cours

## Sous-titre ou module

---

# Slide standard

Contenu de la slide avec du texte normal.

- Premier point
- Deuxieme point
- Troisieme point

---

# Exemple de tableau

| Element | Description | Exemple |
|---------|-------------|---------|
| Variable | Stocke une valeur | `$nom = "test"` |
| Fonction | Bloc reutilisable | `function calc()` |
| Classe | Modele d'objet | `class User` |

---

# Exemple de code

```php
<?php
class Pagination
{
    private int $total;
    private int $perPage;

    public function __construct(int $total, int $perPage = 10)
    {
        $this->total = $total;
        $this->perPage = $perPage;
    }

    public function getPages(): int
    {
        return ceil($this->total / $this->perPage);
    }
}
```

---

# Mise en evidence

**Les mots importants** apparaissent en bleu.

> Les citations ou remarques importantes utilisent ce format.

Code inline : `htmlspecialchars()` protege contre les failles XSS.

---

# Deux colonnes

<div class="columns">
<div>

**Colonne gauche**

- Point A
- Point B
- Point C

</div>
<div>

**Colonne droite**

- Point X
- Point Y
- Point Z

</div>
</div>

---

# Schema ASCII

```
┌─────────────┐     ┌─────────────┐     ┌─────────────┐
│  Controleur │────>│   Modele    │────>│     Vue     │
└─────────────┘     └─────────────┘     └─────────────┘
       │                   │                   │
       └───────────────────┴───────────────────┘
                    Architecture MVC
```

---

# Points cles

1. Premier concept important
2. Deuxieme concept important
3. Troisieme concept important

**A retenir :** Resume de ce qu'il faut retenir de cette slide.

---

<!-- _class: title -->

# Questions ?
