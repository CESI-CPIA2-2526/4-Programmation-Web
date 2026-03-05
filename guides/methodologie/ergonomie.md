---
marp: true
theme: default
paginate: true
footer: 'Ergonomie Web - Projet Mobilite Internationale'
style: |
  section {
    font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    font-size: 26px;
    padding: 40px;
  }
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
    font-size: 16px;
  }
  pre code {
    background-color: transparent;
    color: #f8f8f2;
  }
  footer {
    font-size: 14px;
    color: #95a5a6;
  }
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
---

<!-- _class: title -->

# Ergonomie Web

## Les fondamentaux pour une interface utilisable

Principes essentiels pour votre projet de mobilite internationale

---

# Qu'est-ce que l'ergonomie web ?

**L'art de rendre une interface facile a utiliser**

L'ergonomie (ou UX - User Experience) vise a :

- Reduire l'effort cognitif de l'utilisateur
- Permettre d'atteindre un objectif rapidement
- Eviter les erreurs et frustrations
- Rendre l'experience agreable

---

# Pourquoi c'est important ?

```
Utilisateur arrive sur le site
         │
         ▼
    ┌─────────────┐
    │  3 secondes │  <-- Temps pour convaincre
    └─────────────┘
         │
    ┌────┴────┐
    ▼         ▼
 Reste      Part
(bonne UX)  (mauvaise UX)
```

**50% des utilisateurs** quittent un site s'ils ne comprennent pas comment l'utiliser.

---

# Les 10 heuristiques de Nielsen

Jakob Nielsen a defini 10 principes fondamentaux :

| N | Principe |
|---|----------|
| 1 | Visibilite de l'etat du systeme |
| 2 | Correspondance systeme / monde reel |
| 3 | Controle et liberte de l'utilisateur |
| 4 | Coherence et standards |
| 5 | Prevention des erreurs |

---

# Les 10 heuristiques (suite)

| N | Principe |
|---|----------|
| 6 | Reconnaitre plutot que se souvenir |
| 7 | Flexibilite et efficacite |
| 8 | Design esthetique et minimaliste |
| 9 | Aide a la reconnaissance des erreurs |
| 10 | Aide et documentation |

---

# 1. Visibilite de l'etat du systeme

**L'utilisateur doit toujours savoir ou il en est**

| Situation | Feedback attendu |
|-----------|------------------|
| Chargement en cours | Spinner ou barre de progression |
| Formulaire envoye | Message de confirmation |
| Erreur | Message explicatif |
| Navigation | Fil d'Ariane, menu actif |

---

# Exemple dans votre projet

```
┌─────────────────────────────────────────────────┐
│  Accueil > Opportunites > Allemagne > TU Munich │  <- Fil d'Ariane
├─────────────────────────────────────────────────┤
│                                                 │
│  [■■■■■■■■░░] 80%                               │  <- Progression
│  Telechargement du CV en cours...              │     candidature
│                                                 │
└─────────────────────────────────────────────────┘
```

---

# 2. Correspondance avec le monde reel

**Utiliser le vocabulaire de l'utilisateur**

| A eviter | A privilegier |
|----------|---------------|
| Enregistrement entite | Creer mon compte |
| Soumettre requete | Postuler |
| Instance annulee | Candidature retiree |
| Error 404 | Page introuvable |

---

# 3. Controle et liberte

**Permettre de revenir en arriere facilement**

- Bouton "Retour" visible
- Annuler une action (supprimer un favori)
- Modifier avant validation finale
- Sauvegarder un brouillon

> L'utilisateur ne doit jamais se sentir piege.

---

# Exemple : Candidature multi-etapes

```
┌─────────────────────────────────────────────────┐
│                                                 │
│   Etape 1      Etape 2      Etape 3      Etape 4│
│   [●]─────────[●]─────────[○]─────────[○]       │
│   Infos       Documents    Motivation   Resume  │
│                                                 │
│   ┌─────────┐              ┌─────────┐          │
│   │ Retour  │              │ Suivant │          │
│   └─────────┘              └─────────┘          │
│                                                 │
│   [ Sauvegarder le brouillon ]                  │
│                                                 │
└─────────────────────────────────────────────────┘
```

---

# 4. Coherence et standards

**Respecter les conventions etablies**

| Element | Convention |
|---------|------------|
| Logo | Cliquable, ramene a l'accueil |
| Lien | Souligne ou colore |
| Bouton principal | Couleur distinctive |
| Icone panier/favoris | En haut a droite |
| Recherche | En haut, avec icone loupe |

---

# Coherence interne

**Meme action = meme apparence partout**

```
Page Universites          Page Opportunites
┌──────────────┐          ┌──────────────┐
│ [Rechercher] │    =     │ [Rechercher] │   <- Meme style
└──────────────┘          └──────────────┘

┌──────────────┐          ┌──────────────┐
│ ♡ Favoris    │    =     │ ♡ Favoris    │   <- Meme icone
└──────────────┘          └──────────────┘
```

---

# 5. Prevention des erreurs

**Mieux vaut prevenir que guerir**

| Technique | Exemple |
|-----------|---------|
| Desactiver bouton | Griser "Envoyer" si champs vides |
| Confirmation | "Voulez-vous vraiment supprimer ?" |
| Autocompletion | Suggerer les pays existants |
| Format attendu | Placeholder "jj/mm/aaaa" |

---

# Exemple : Formulaire securise

```html
<!-- Empecher les erreurs de saisie -->
<label for="email">Email</label>
<input type="email"
       id="email"
       placeholder="exemple@mail.com"
       required>

<label for="date">Date de depart souhaitee</label>
<input type="date"
       id="date"
       min="2025-09-01"
       max="2026-09-01">
```

---

# 6. Reconnaitre plutot que se souvenir

**Afficher les options, ne pas les cacher**

| A eviter | A privilegier |
|----------|---------------|
| Menu cache par defaut | Menu visible |
| Codes a retenir | Listes deroulantes |
| "Voir plus" partout | Informations visibles |
| Raccourcis uniquement | Boutons explicites |

---

# Exemple : Filtres visibles

```
┌─────────────────────────────────────────────────┐
│  FILTRER LES OPPORTUNITES                       │
├─────────────────────────────────────────────────┤
│                                                 │
│  Pays:        [Tous les pays        ▼]          │
│                                                 │
│  Type:        ○ Semestre  ○ Stage  ○ Double dip │
│                                                 │
│  Domaine:     □ Info  □ Industrie  □ BTP        │
│                                                 │
│  [ Appliquer les filtres ]  [ Reinitialiser ]   │
│                                                 │
└─────────────────────────────────────────────────┘
```

---

# 7. Flexibilite et efficacite

**S'adapter aux utilisateurs novices ET experts**

| Novice | Expert |
|--------|--------|
| Menu complet | Raccourcis clavier |
| Tutoriel au premier usage | Option "Ne plus afficher" |
| Etapes guidees | Formulaire rapide |

---

# 8. Design minimaliste

**Chaque element doit avoir une raison d'etre**

Regles a suivre :

- Une seule action principale par page
- Hierarchie visuelle claire
- Espaces blancs pour aerer
- Pas de texte superflu

---

# Hierarchie visuelle

```
┌─────────────────────────────────────────────────┐
│                                                 │
│  UNIVERSITE TECHNIQUE DE MUNICH                 │  <- Titre principal
│  ─────────────────────────────────              │
│                                                 │
│  Allemagne · Munich · 45 000 etudiants          │  <- Infos cles
│                                                 │
│  ★★★★☆ (4.2/5 - 28 avis)                        │  <- Note
│                                                 │
│  Description de l'universite et des programmes  │  <- Details
│  disponibles pour les etudiants en echange...   │
│                                                 │
│        [ VOIR LES OPPORTUNITES ]                │  <- Action principale
│                                                 │
└─────────────────────────────────────────────────┘
```

---

# 9. Messages d'erreur utiles

**Expliquer le probleme ET la solution**

| Mauvais | Bon |
|---------|-----|
| Erreur | Le fichier est trop volumineux |
| Champ invalide | Le format attendu est jj/mm/aaaa |
| Echec | Votre session a expire, reconnectez-vous |
| 500 Internal Error | Une erreur est survenue, reessayez |

---

# Exemple : Validation de formulaire

```
┌─────────────────────────────────────────────────┐
│                                                 │
│  Email *                                        │
│  ┌─────────────────────────────────────────┐    │
│  │ jean.dupont@                            │    │
│  └─────────────────────────────────────────┘    │
│  ⚠ Adresse email incomplete (ex: nom@mail.com) │
│                                                 │
│  CV (PDF, max 2 Mo) *                           │
│  ┌─────────────────────────────────────────┐    │
│  │ mon_cv.docx                             │    │
│  └─────────────────────────────────────────┘    │
│  ⚠ Format non accepte. Formats autorises : PDF  │
│                                                 │
└─────────────────────────────────────────────────┘
```

---

# 10. Aide et documentation

**Accessible mais pas indispensable**

- FAQ pour les questions frequentes
- Tooltips sur les champs complexes
- Page d'aide structuree
- Contact support visible

> Un bon design ne devrait pas necessiter de documentation.

---

# Navigation : les bases

## Structure recommandee

```
┌─────────────────────────────────────────────────┐
│  LOGO     Accueil  Opportunites  Universites    │  <- Navigation
│                                    [Connexion]  │     principale
├─────────────────────────────────────────────────┤
│                                                 │
│                   CONTENU                       │
│                                                 │
├─────────────────────────────────────────────────┤
│  A propos | Contact | Mentions legales | RGPD   │  <- Footer
└─────────────────────────────────────────────────┘
```

---

# Navigation : regles

| Regle | Explication |
|-------|-------------|
| 3 clics maximum | Atteindre toute page en 3 clics |
| Menu visible | Toujours accessible |
| Page active | Highlight du menu courant |
| Fil d'Ariane | Pour les arborescences profondes |

---

# Navigation mobile

## Menu burger

```
┌───────────────────────┐
│  ☰  LOGO    [Avatar]  │
├───────────────────────┤     ┌───────────────────┐
│                       │     │  ☰  LOGO          │
│                       │     ├───────────────────┤
│      CONTENU          │ --> │ > Accueil         │
│                       │     │ > Opportunites    │
│                       │     │ > Universites     │
│                       │     │ > Mon compte      │
│                       │     │ > Deconnexion     │
└───────────────────────┘     └───────────────────┘
     Ferme                         Ouvert
```

---

# Formulaires : bonnes pratiques

| Pratique | Raison |
|----------|--------|
| Labels au-dessus | Plus lisible sur mobile |
| Champs obligatoires marques | Evite les erreurs |
| Validation en temps reel | Feedback immediat |
| Bouton explicite | "Envoyer ma candidature" > "Submit" |

---

# Formulaires : structure

```
┌─────────────────────────────────────────────────┐
│  POSTULER A CETTE OPPORTUNITE                   │
├─────────────────────────────────────────────────┤
│                                                 │
│  Informations personnelles                      │
│  ─────────────────────────                      │
│  Nom *            [____________________]        │
│  Prenom *         [____________________]        │
│  Email *          [____________________]        │
│                                                 │
│  Documents                                      │
│  ─────────                                      │
│  CV (PDF) *       [Parcourir...]                │
│  Lettre motiv.    [Parcourir...]                │
│                                                 │
│              [ Envoyer ma candidature ]         │
│                                                 │
└─────────────────────────────────────────────────┘
```

---

# Accessibilite : les bases

**Rendre le site utilisable par tous**

| Critere | Implementation |
|---------|----------------|
| Contraste | Texte lisible (ratio 4.5:1 minimum) |
| Taille police | Minimum 16px pour le corps |
| Alt images | Description pour lecteurs d'ecran |
| Focus visible | Outline sur elements interactifs |

---

# Accessibilite : code HTML

```html
<!-- Mauvais -->
<div onclick="submit()">Envoyer</div>

<!-- Bon -->
<button type="submit">Envoyer</button>

<!-- Mauvais -->
<img src="logo.png">

<!-- Bon -->
<img src="logo.png" alt="Logo Mobilite Internationale">

<!-- Mauvais -->
<input placeholder="Votre email">

<!-- Bon -->
<label for="email">Email</label>
<input id="email" type="email" placeholder="exemple@mail.com">
```

---

# Responsive : les breakpoints

| Breakpoint | Cible |
|------------|-------|
| < 576px | Mobile portrait |
| 576px - 768px | Mobile paysage / Tablette |
| 768px - 992px | Tablette |
| 992px - 1200px | Desktop |
| > 1200px | Grand ecran |

---

# Responsive : Mobile First

**Concevoir d'abord pour mobile, puis adapter**

```css
/* Style de base (mobile) */
.card {
  width: 100%;
  padding: 1rem;
}

/* Tablette */
@media (min-width: 768px) {
  .card {
    width: 50%;
  }
}

/* Desktop */
@media (min-width: 992px) {
  .card {
    width: 33.33%;
  }
}
```

---

# Responsive : adaptation du contenu

```
DESKTOP                          MOBILE
┌────────────────────────┐       ┌──────────┐
│ CARD │ CARD │ CARD     │       │   CARD   │
├──────┴──────┴──────────┤       ├──────────┤
│                        │  -->  │   CARD   │
│       CONTENU          │       ├──────────┤
│                        │       │   CARD   │
└────────────────────────┘       └──────────┘
     3 colonnes                   1 colonne
```

---

# Performance et ergonomie

**Un site lent = mauvaise UX**

| Metrique | Objectif |
|----------|----------|
| First Contentful Paint | < 1.8s |
| Largest Contentful Paint | < 2.5s |
| Time to Interactive | < 3.0s |

---

# Optimisations de base

| Technique | Gain |
|-----------|------|
| Compresser images | -70% taille |
| Minifier CSS/JS | -30% taille |
| Lazy loading images | Chargement differe |
| Cache navigateur | Pas de re-telechargement |

---

# Anti-patterns a eviter

| Probleme | Impact |
|----------|--------|
| Carrousel automatique | Contenu manque |
| Pop-up immediate | Frustration |
| Infinite scroll sans repere | Perte de position |
| Captcha trop frequent | Abandon |
| Texte sur image sans contraste | Illisible |

---

# Anti-patterns (suite)

| Probleme | Impact |
|----------|--------|
| Lien ouvrant nouvel onglet | Perte du bouton retour |
| Formulaire sans sauvegarde | Perte de donnees |
| Menu trop profond | Navigation complexe |
| Police trop petite | Fatigue visuelle |
| Pas de feedback au clic | Doute sur l'action |

---

# Checklist ergonomie

## Navigation

- [ ] Logo cliquable vers accueil
- [ ] Menu visible et coherent
- [ ] Fil d'Ariane si necessaire
- [ ] Page active identifiable
- [ ] Menu burger sur mobile

---

# Checklist (suite)

## Formulaires

- [ ] Labels visibles
- [ ] Champs obligatoires marques (*)
- [ ] Messages d'erreur explicites
- [ ] Validation en temps reel
- [ ] Bouton d'action explicite

---

# Checklist (suite)

## Accessibilite

- [ ] Contraste suffisant
- [ ] Alt sur les images
- [ ] Focus visible
- [ ] Navigation au clavier possible
- [ ] Taille de police adequate

---

# Checklist (suite)

## Responsive

- [ ] Test sur mobile reel
- [ ] Menu adapte (burger)
- [ ] Images redimensionnees
- [ ] Touch targets > 44px
- [ ] Texte lisible sans zoom

---

# Outils de test

| Outil | Usage |
|-------|-------|
| Chrome DevTools | Responsive, performance |
| Lighthouse | Audit complet (accessibilite, SEO, perf) |
| WAVE | Accessibilite |
| WebAIM Contrast | Verification contraste |
| PageSpeed Insights | Performance |

---

# Ressources

| Ressource | Lien |
|-----------|------|
| Nielsen Norman Group | nngroup.com |
| Web Content Accessibility Guidelines | w3.org/WAI/WCAG21 |
| Material Design Guidelines | material.io/design |
| Refactoring UI | refactoringui.com |

---

# Resume

1. **Feedback** : L'utilisateur sait toujours ou il en est
2. **Coherence** : Memes actions, memes apparences
3. **Prevention** : Eviter les erreurs avant qu'elles arrivent
4. **Clarte** : Messages explicites et vocabulaire adapte
5. **Accessibilite** : Utilisable par tous
6. **Performance** : Rapide et reactif

---

<!-- _class: title -->

# A vous de jouer

Testez votre site avec un utilisateur externe

Le meilleur test : observer quelqu'un utiliser votre site sans l'aider
