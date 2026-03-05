# Projet Web - Plateforme de Mobilite Internationale

## 1. Presentation du projet

Les etudiants souhaitant effectuer une mobilite internationale (semestre d'echange, double diplome, stage a l'etranger) doivent actuellement rechercher les opportunites de maniere dispersee : sites des universites partenaires, anciens etudiants, services des relations internationales, etc.

Afin de centraliser et faciliter cette recherche, il serait necessaire de disposer d'un site web qui regroupe les differentes opportunites de mobilite, les universites partenaires, les retours d'experience des anciens etudiants, et qui permettra de gerer les candidatures de maniere centralisee.

### 1.1 Deroulement

Le projet se deroule pratiquement tout le long du bloc. Des temps projets sont prevus regulierement, ce qui vous permettra d'avancer progressivement votre projet a l'aide de vos nouvelles connaissances acquises a l'issue de chaque prosit. Les livrables des prosits seront directement des fonctionnalites du projet.

Le projet est dimensionne pour des groupes de 4 eleves.

#### Phases du projet

| Phase | Description | Details | Periode |
|-------|-------------|---------|---------|
| Phase 1 | Lancement de projet | Constitution des groupes, prise de connaissance du cahier des charges, application de la methode Scrum (repartition des roles, backlog, planification des sprints, daily, etc.) | Terminee |
| Phase 2 | Maquettage puis frontend (HTML/CSS) | Realisation d'une maquette (wireframe), definition des liens entre les pages, approche Mobile first, demarrage du developpement front-end | 03 - 14 fev |
| Phase 3 | Modelisation (MCD) | Conception du modele conceptuel de donnees et mise en place de la base de donnees | 10 - 14 fev |
| Phase 4 | Developpement du backend | Demarrage du developpement backend avec architecture MVC | 03 - 14 mars |
| Phase 5 | Developpement du backend (suite) | Implementation de l'authentification, connexion a la base de donnees, ecriture des tests unitaires | 17 - 28 mars |
| Phase 6 | Finalisation | Ajout des parties developpees en Javascript, corrections et polish | 31 mars - 03 avril |

#### Calendrier

| Date | Jalon |
|------|-------|
| 03 fevrier | Debut de la phase 2 (front-end) |
| 10 fevrier | Debut de la phase 3 (MCD) - peut chevaucher la fin de phase 2 |
| 14 fevrier | Front-end HTML/CSS et MCD termines |
| 16 fevrier - 02 mars | **Vacances** |
| 03 mars | Reprise - Debut du developpement backend |
| 17 mars | Debut phase 5 (BDD, Auth, Tests) |
| 31 mars | Debut de la finalisation Javascript |
| 03 avril | **Soutenance finale** |

**Conseil d'organisation :** Profitez des vacances pour consolider vos connaissances et eventuellement avancer sur la documentation ou la conception. Le retour de vacances marque le debut intensif du backend : soyez prets.

### 1.2 Livrable

Le bloc termine par une soutenance. Durant cette derniere, vous allez vous positionner comme le prestataire (Web4All) qui vient montrer a son client CESI (le jury) le resultat de sa commande.

La soutenance peut etre composee d'une petite presentation de 5 minutes et surtout d'une demonstration technique. Le temps etant compte, le jury pourra vous guider par ses questions pour verifier telle ou telle specificite (fonctionnelle comme technique). La sequence se terminera hors contexte par des questions/reponses individuelles permettant d'evaluer votre implication personnelle dans le projet.

### 1.3 Presentations

Des presentations intermediaires sont prevues chaque vendredi. Consultez le document [Presentations.md](Presentations.md) pour les details et consignes de chaque format.

---

## 2. Cahier des charges

La realisation d'une application web pour la mobilite internationale se trouve etre un projet plein d'ambitions. Le site va permettre d'informatiser l'aide a la recherche de mobilites en regroupant toutes les opportunites disponibles. Il permettra entre autres d'enregistrer les donnees des universites partenaires, les retours d'experience, et de gerer les dossiers de candidature.

Les opportunites de mobilite seront notamment classees par pays, type de programme et domaine d'etude, ce qui permettra a l'etudiant de trouver une mobilite en rapport avec son projet professionnel.

### Profils d'utilisateurs

| Profil | Description |
|--------|-------------|
| Administrateur | Acces a l'ensemble des fonctionnalites proposees par la plateforme |
| Responsable Relations Internationales | Gestion des partenariats, validation des candidatures, suivi des etudiants |
| Etudiant | Recherche d'opportunites et candidature aux programmes de mobilite |

### Exigences generales

- Le site doit s'adapter en fonction de l'equipement de l'utilisateur (responsive)
- Respecter les bonnes pratiques de codage cote back-end comme front-end
- Repondre aux criteres d'optimisation SEO de base
- Inclure des balises meta adequates pour chaque section importante
- Conformite legale (mentions legales obligatoires, RGPD)
- Utiliser un serveur de base de donnees commun au groupe (recommande)

---

## 3. Specifications fonctionnelles

### 3.1 Gestion d'acces

| Code | Fonctionnalite | Description | Donnees |
|------|----------------|-------------|---------|
| SFx 1 | Authentification et gestion des acces | Authentification via formulaire de connexion, deconnexion, gestion des permissions selon les roles | email, mot de passe, role et permissions |

### 3.2 Gestion des universites partenaires

| Code | Fonctionnalite | Description | Donnees |
|------|----------------|-------------|---------|
| SFx 2 | Rechercher et afficher une universite | Recherche sur plusieurs criteres, consultation des programmes et des avis | nom, pays, ville, description, programmes disponibles, moyenne des evaluations |
| SFx 3 | Creer une universite partenaire | Creation de la fiche universite | nom, pays, ville, description, contact |
| SFx 4 | Modifier une universite | Modification de la fiche universite | nom, pays, ville, description, contact |
| SFx 5 | Evaluer une universite | Evaluation par les anciens etudiants partis en mobilite | evaluation, commentaire |
| SFx 6 | Supprimer une universite | Retrait d'une universite partenaire du systeme | - |

### 3.3 Gestion des opportunites de mobilite

| Code | Fonctionnalite | Description | Donnees |
|------|----------------|-------------|---------|
| SFx 7 | Rechercher et afficher une opportunite | Recherche sur plusieurs criteres et affichage detaille | universite, type de programme, duree, domaine, places disponibles, date limite |
| SFx 8 | Creer une opportunite | Creation et parametrage d'une opportunite de mobilite | universite, type, duree, domaine, places, dates |
| SFx 9 | Modifier une opportunite | Modification d'une opportunite et de ses parametres | universite, type, duree, domaine, places, dates |
| SFx 10 | Supprimer une opportunite | Retrait d'une opportunite du systeme | - |
| SFx 11 | Consulter les statistiques | Tableau de bord avec indicateurs cles | repartition par pays, top destinations, nombre de candidatures, taux d'acceptation |

### 3.4 Gestion des responsables RI

| Code | Fonctionnalite | Description | Donnees |
|------|----------------|-------------|---------|
| SFx 12 | Rechercher et afficher un compte Responsable RI | Recherche d'un compte Responsable | nom, prenom, campus |
| SFx 13 | Creer un compte Responsable RI | Creation d'un compte Responsable | nom, prenom, campus |
| SFx 14 | Modifier un compte Responsable RI | Modification d'un compte Responsable | nom, prenom, campus |
| SFx 15 | Supprimer un compte Responsable RI | Suppression d'un compte Responsable | - |

### 3.5 Gestion des etudiants

| Code | Fonctionnalite | Description | Donnees |
|------|----------------|-------------|---------|
| SFx 16 | Rechercher et afficher un compte Etudiant | Recherche sur plusieurs criteres, affichage du statut de candidature | nom, prenom, email, formation |
| SFx 17 | Creer un compte Etudiant | Creation d'un compte Etudiant | nom, prenom, email, formation |
| SFx 18 | Modifier un compte Etudiant | Modification d'un compte Etudiant | nom, prenom, email, formation |
| SFx 19 | Supprimer un compte Etudiant | Suppression d'un compte Etudiant | - |

### 3.6 Gestion des candidatures

| Code | Fonctionnalite | Description | Donnees |
|------|----------------|-------------|---------|
| SFx 20 | Postuler a une opportunite | L'etudiant postule avec lettre de motivation et documents requis | opportunite, CV, LM, releves de notes |
| SFx 21 | Afficher les candidatures de l'etudiant | Liste des opportunites auxquelles l'etudiant a postule et statut | opportunite, documents, statut |
| SFx 22 | Afficher les candidatures (Responsable RI) | Liste des candidatures a traiter avec outils de validation | opportunite, etudiant, documents, statut |

### 3.7 Gestion des favoris

| Code | Fonctionnalite | Description |
|------|----------------|-------------|
| SFx 23 | Afficher les opportunites favorites | Consultation des opportunites ajoutees aux favoris |
| SFx 24 | Ajouter une opportunite aux favoris | Ajout d'une opportunite a la liste d'interets |
| SFx 25 | Retirer une opportunite des favoris | Suppression d'une opportunite de la liste d'interets |

### 3.8 Fonctionnalites transversales

| Code | Fonctionnalite | Description |
|------|----------------|-------------|
| SFx 27 | Pagination | Chaque affichage de donnees nombreuses doit contenir une pagination |
| SFx 28 | Mentions legales | Respecter la reglementation en vigueur (RGPD inclus) |

### 3.9 Bonus

**Acces mobile (PWA)** : Transformation de l'application web en application mobile installable (icone sur ecran, navigation plein ecran, navigation hors-ligne).

---

## 4. Specifications techniques

### Architecture et conformite

| Code | Specification | Details |
|------|---------------|---------|
| STx 1 | Architecture | Architecture MVC obligatoire |
| STx 2 | Conformite du code | Balises semantiques HTML5, validation W3C, CSS structure, POO en PHP, conventions PSR-12 |
| STx 3 | Controle des formulaires | Verification et validation cote front (HTML/JS) et back (PHP) |
| STx 4 | Interdiction CMS | Aucun CMS (WordPress, Drupal, Joomla, etc.) |
| STx 5 | Framework | Interdiction des frameworks frontend (React, Angular, Vue.js) et backend (Laravel, Symfony). Preprocesseurs CSS (LESS/Sass) et jQuery autorises |

### Stack technique

| Code | Specification | Details |
|------|---------------|---------|
| STx 6 | Stack technique | Serveur: Apache / Frontend: HTML5, CSS3, JS / Backend: PHP / BDD: SGBD SQL (MySQL, PostgreSQL, MariaDB) |
| STx 7 | Moteur de template | Utilisation obligatoire d'un moteur de template cote Backend |
| STx 8 | Cles etrangeres | Les relations SGBD doivent exploiter des cles etrangeres |
| STx 9 | Vhost | Un vhost specifique pour le contenu statique (images, CSS, JS) |

### Design et securite

| Code | Specification | Details |
|------|---------------|---------|
| STx 10 | Responsive Design | Adaptation aux differentes tailles d'ecran, menu burger pour mobiles/tablettes |
| STx 11 | Securite | Cookies securises, chiffrement des donnees sensibles, protection contre injections SQL/XSS/CSRF, HTTPS |
| STx 12 | SEO | Balises optimisees (title, meta, Hn, alt), mots-cles, temps de chargement < 3s, URLs lisibles, sitemap.xml et robots.txt |
| STx 13 | Routage d'URL | Systeme de routage cote Backend pour URLs lisibles et coherentes |
| STx 14 | Tests unitaires | Tests unitaires pour au moins un controleur avec PHPUnit |

---

## 5. Ressources

### Matrice des permissions

Fichier : `Matrice permissions 2025 V2.1.xlsx`

---

## 6. Evaluation

### Modalite

Toutes les specifications techniques et fonctionnelles enoncees dans le cahier des charges rentrent dans l'evaluation finale.

La participation de l'etudiant au travail d'equipe sera fortement impactante sur les notes de soutenance.

### Grille d'evaluation

Fichier : `Grille_Evaluation_Projet_Web_2025_V1.1.xlsx`
