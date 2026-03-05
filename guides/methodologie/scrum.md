---
marp: true
theme: default
paginate: true
footer: 'Guide Scrum - Projet Web'
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

# Guide Scrum

## Projet Web - Mobilite Internationale

Methodologie agile pour livrer de la valeur de maniere iterative

---

# Pourquoi Scrum ?

## Le probleme de la methode en cascade

```
Specification ──> Developpement ──> Tests ──> Livraison
    (2 sem)         (4 sem)        (1 sem)     (1 jour)
                                                  │
                                                  ▼
                                    "Ce n'est pas ce que je voulais"
```

Le client decouvre le resultat **7 semaines** apres le debut.

---

# L'approche Scrum

```
┌─────────┐   ┌─────────┐   ┌─────────┐   ┌─────────┐
│Sprint 1 │──>│Sprint 2 │──>│Sprint 3 │──>│Sprint 4 │
│ 1 sem   │   │ 1 sem   │   │ 1 sem   │   │ 1 sem   │
└────┬────┘   └────┬────┘   └────┬────┘   └────┬────┘
     │             │             │             │
     ▼             ▼             ▼             ▼
  Feedback      Feedback      Feedback      Feedback
   client        client        client        client
```

Le client voit le produit evoluer **chaque semaine**.

---

# Les 3 piliers de Scrum

| Pilier | Description |
|--------|-------------|
| **Transparence** | Tout le monde voit l'avancement |
| **Inspection** | On verifie regulierement le travail |
| **Adaptation** | On ajuste selon les retours |

---

# Les roles Scrum

```
    ┌─────────────────┐
    │  Product Owner  │  ──>  Definit le QUOI
    └─────────────────┘

    ┌─────────────────┐
    │  Scrum Master   │  ──>  Facilite le COMMENT travailler
    └─────────────────┘

    ┌─────────────────┐
    │  Developpeurs   │  ──>  Definit le COMMENT techniquement
    └─────────────────┘
```

---

# Organisation pour vos groupes

## Equipe de 3 personnes

| Role | Responsabilite | Cumul |
|------|----------------|-------|
| Product Owner | Priorites, validation | + Dev |
| Scrum Master | Rituels, blocages | + Dev |
| Developpeur | Realisation | Principal |

---

# Organisation pour vos groupes

## Equipe de 2 personnes

| Role | Responsabilite |
|------|----------------|
| PO + Developpeur | Priorites et code |
| SM + Developpeur | Rituels et code |

Les deux personnes partagent les responsabilites.

---

# Le Product Owner (PO)

**Represente le client - Definit le QUOI**

Responsabilites :

- Rediger et prioriser les User Stories
- Definir les criteres d'acceptation
- Valider les livrables a chaque fin de sprint
- Arbitrer les choix fonctionnels

---

# Le Product Owner - Exemples

Dans votre projet :

- Decide quelles pages developper en priorite
- Valide que "Postuler a une offre" repond au besoin
- Tranche : recherche ou favoris d'abord ?

---

# Le Scrum Master

**Garant de la methode - Facilite le travail**

Responsabilites :

- Animer les rituels (planning, daily, review, retro)
- Proteger l'equipe des perturbations
- Lever les blocages
- S'assurer du respect des engagements

---

# Le Scrum Master - Exemples

Dans votre projet :

- Organise le daily de 10 minutes
- Aide sur une config Apache bloquante
- Rappelle : pas de changement de scope en cours de sprint

---

# L'equipe de developpement

**Realise le travail - Definit le COMMENT technique**

Responsabilites :

- Estimer la complexite des taches
- S'auto-organiser pour l'objectif du sprint
- Produire un increment fonctionnel et teste
- Respecter les standards (PSR-12, W3C)

---

# L'equipe - Exemples

Dans votre projet :

- Decide d'utiliser Twig comme moteur de template
- Repartit : "Tu fais le front, je fais le back"
- S'engage a livrer 3 User Stories ce sprint

---

# Les artefacts Scrum

```
┌──────────────────────────────────────────────────────┐
│                   PRODUCT BACKLOG                     │
│  Toutes les fonctionnalites souhaitees (priorisees)  │
└──────────────────────┬───────────────────────────────┘
                       │ Selection
                       ▼
┌──────────────────────────────────────────────────────┐
│                   SPRINT BACKLOG                      │
│     Les items choisis pour ce sprint uniquement       │
└──────────────────────┬───────────────────────────────┘
                       │ Realisation
                       ▼
┌──────────────────────────────────────────────────────┐
│                     INCREMENT                         │
│      Fonctionnalite terminee et deployable           │
└──────────────────────────────────────────────────────┘
```

---

# Le Product Backlog

**Liste ordonnee de tout ce qui doit etre fait**

Structure d'une User Story :

```
En tant que [role utilisateur]
Je veux [fonctionnalite]
Afin de [benefice]
```

---

# Exemple de User Story

```
En tant qu'etudiant
Je veux rechercher des opportunites par pays
Afin de trouver rapidement une destination

Criteres d'acceptation :
- [ ] Filtre par pays fonctionnel
- [ ] Pagination (10 resultats/page)
- [ ] Message si aucun resultat
```

---

# Le Sprint Backlog

**Decomposition en taches techniques**

| User Story | Tache | Estimation |
|------------|-------|------------|
| Recherche par pays | Formulaire HTML | 2h |
| | Controleur PHP | 3h |
| | Requete SQL | 1h |
| | Pagination | 2h |
| | Tests | 2h |

---

# Definition of Done (DoD)

**Quand une fonctionnalite est-elle "terminee" ?**

- Code valide W3C (HTML)
- Code conforme PSR-12 (PHP)
- Fonctionnalite testee manuellement
- Responsive design verifie
- Code pousse sur Git

---

# Les evenements Scrum

```
LUNDI                                              VENDREDI
  │                                                    │
  ▼                                                    ▼
┌──────────┐   ┌───────┐   ┌───────┐   ┌───────┐   ┌──────────┐
│ Planning │──>│ Daily │──>│ Daily │──>│ Daily │──>│  Review  │
│   1h     │   │ 10min │   │ 10min │   │ 10min │   │  30min   │
└──────────┘   └───────┘   └───────┘   └───────┘   └────┬─────┘
                                                        │
                                                        ▼
                                                   ┌──────────┐
                                                   │  Retro   │
                                                   │  30min   │
                                                   └──────────┘
```

---

# Sprint Planning

**Objectif :** Definir ce qu'on va realiser

Deroulement (1h) :

1. Le PO presente les items prioritaires (15 min)
2. L'equipe pose des questions (15 min)
3. L'equipe estime et selectionne (20 min)
4. Decomposition en taches (10 min)

---

# Sprint Planning - Resultat

**Objectif de sprint clair et mesurable**

Exemples :

- "Un etudiant peut s'inscrire et se connecter"
- "La liste des opportunites est affichee avec pagination"
- "Un etudiant peut postuler avec CV"

---

# Daily Scrum (Stand-up)

**Objectif :** Synchroniser et identifier les blocages

Chaque membre repond a 3 questions :

| Question | Exemple |
|----------|---------|
| Hier ? | "Formulaire d'inscription termine" |
| Aujourd'hui ? | "Validation cote serveur" |
| Blocage ? | "Config sessions PHP..." |

---

# Daily Scrum - Regles

- **15 minutes maximum**
- Debout (pour rester concis)
- Pas de resolution de probleme pendant
- Les discussions techniques : apres, en apart

---

# Sprint Review (Demo)

**Objectif :** Montrer le travail et recueillir du feedback

Deroulement (30 min) :

1. Demo live des fonctionnalites (20 min)
2. Le PO valide ou invalide (5 min)
3. Discussion sur la suite (5 min)

---

# Sprint Review - Conseils

- Preparer un scenario realiste

> "Je suis un etudiant qui cherche une mobilite..."

- Montrer le site fonctionnel, pas des slides
- Accepter les retours sans se justifier

---

# Sprint Retrospective

**Objectif :** Ameliorer le fonctionnement de l'equipe

| Keep | Stop | Start |
|------|------|-------|
| Ce qui a marche | Ce qu'on arrete | Ce qu'on commence |
| "Bonne repartition" | "Coder sans sync" | "Code reviews" |

---

# Sprint Retrospective - Action

Choisir **1 a 2 ameliorations** concretes

Exemples :

- "On fera un point rapide a 14h en plus du daily"
- "On utilisera des branches Git pour chaque feature"
- "On testera sur mobile avant de valider"

---

# Tableau Kanban

```
┌─────────────┬─────────────┬─────────────┬─────────────┐
│   A FAIRE   │  EN COURS   │  A TESTER   │   TERMINE   │
├─────────────┼─────────────┼─────────────┼─────────────┤
│  Story 4    │  Story 2    │  Story 1    │             │
│  Story 5    │  (Alice)    │             │             │
│             │  Story 3    │             │             │
│             │  (Bob)      │             │             │
└─────────────┴─────────────┴─────────────┴─────────────┘
```

---

# A vous de jouer

**Lundi 09 fevrier - Sprint 1**

1. Attribuer les roles
2. Creer le Product Backlog
3. Sprint Planning (1h)
4. C'est parti !
