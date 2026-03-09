# Boucle PBL : PDO - Sessions - Authentification

**Type :** Prosit / Workshop — **Thème :** PDO, requêtes préparées, sessions, cookies, authentification

**Votre mission :** Connecter l'application Web4all à la base de données via PDO pour implémenter les CRUD des entités, sécuriser les saisies contre les injections SQL, mettre en place l'authentification avec gestion des rôles via sessions/cookies, et évaluer les technologies de développement mobile.

**Livrables :**

| Livrable | Ce qu'on attend |
|----------|-----------------|
| Connexion PDO | Classe de connexion générique et réutilisable |
| CRUD entreprises | Formulaires de saisie, modification et affichage reliés à la BDD |
| Requêtes préparées | Toutes les requêtes utilisent des requêtes préparées (protection injection SQL) |
| Authentification | Page de connexion avec gestion de session et matrice des droits d'accès |
| CRUD offres de stage | Formulaires offres + wish-list reliés à la BDD *(si le temps le permet)* |
| Veille mobile | Synthèse des technologies mobiles et recommandation argumentée |

---

## Objectifs d'apprentissage

### PDO et abstraction de base de données

* **[1]** Expliquer l'intérêt d'une couche d'abstraction pour l'accès aux bases de données.
* **[2]** Décrire le fonctionnement de PDO et ses avantages par rapport aux extensions spécifiques (MySQLi...).
* **[3]** Mettre en place une connexion PDO dans une architecture MVC.
* **[4]** Implémenter les opérations CRUD à l'aide de PDO.

### Sécurité et requêtes préparées

* **[1]** Définir ce qu'est une injection SQL et expliquer ses risques.
* **[2]** Expliquer le mécanisme des requêtes préparées et leur rôle dans la sécurisation.
* **[3]** Utiliser les requêtes préparées PDO avec des paramètres liés pour sécuriser les entrées utilisateur.

### Sessions, cookies et authentification

* **[1]** Distinguer session et cookie et expliquer leurs cas d'usage respectifs.
* **[2]** Mettre en place un système d'authentification avec `$_SESSION`.
* **[3]** Implémenter une matrice de droits d'accès pour restreindre les pages selon le rôle de l'utilisateur.

### Développement mobile

* **[1]** Citer les principales approches de développement mobile (natif, hybride, PWA).
* **[2]** Comparer les technologies mobiles selon leur coût, rapidité de développement et périmètre fonctionnel.

---

## Sujet : Énoncé

### C'est parti mon cookie

*Ce matin dans les locaux de Web4all...*

**Jean-Marc :**

> « Bonjour à tous. Bonne nouvelle : les maquettes sont finalisées et le serveur tourne. Les premières pages PHP s'affichent correctement. Maintenant on passe à la partie la plus croustillante : la base de données. Sami, c'est toi qui vas porter ça côté backend. »

**Sami :**

> « J'attendais ce moment ! Quelle librairie on utilise pour accéder à la BDD ? »

**Estelle :**

> « On part sur PDO. C'est une couche d'abstraction qui nous affranchit du SGBD sous-jacent. Et surtout, elle supporte nativement les requêtes préparées. »

**Sami :**

> « Ce qui veut dire qu'on est protégés contre les injections SQL ? »

**Estelle :**

> « Exactement. Les paramètres sont séparés de la requête SQL, donc un utilisateur malveillant ne peut pas modifier la structure de la requête en saisissant du code SQL dans un formulaire. »

**Jean-Marc :**

> « Très bien. La priorité, c'est de dynamiser les formulaires de saisie, modification et affichage d'une entreprise. Toutes les données doivent atterrir dans la base correctement. Si le temps le permet, on fera de même pour les offres de stage et la wish-list. »

**Dominique :**

> « Et pour la partie authentification ? Le cahier des charges mentionne des restrictions d'accès selon les rôles. »

**Jean-Marc :**

> « Oui, on a une matrice des droits d'accès à respecter. Les pilotes et les administrateurs n'ont pas les mêmes accès que les étudiants. On va gérer ça avec des sessions, et éventuellement des cookies pour les connexions persistantes. On commence par la page de création d'offre de stage, réservée aux pilotes et administrateurs. »

**Sami :**

> « Compris. Donc : connexion PDO, CRUD entreprises, requêtes préparées partout, puis authentification et gestion des rôles. »

**Jean-Marc :**

> « C'est ça. Et autre chose : le client a évoqué l'idée d'une application mobile. Rien n'est décidé, on ne lance pas de développement. Mais Web4all n'a pas de compétence dans le domaine — il serait utile de faire une petite veille sur les technologies existantes et d'identifier laquelle serait la moins coûteuse pour un développement rapide, le cas échéant. »

**Estelle :**

> « Je m'en charge. Natif, hybride, PWA... je ferai une synthèse. »

**Jean-Marc :**

> « Parfait. On fait le point dans deux jours ? »

**Sami, Dominique et Estelle :**

> « D'accord ! »

---

## Ressources pour les étudiants

### PDO et base de données

* [Injection SQL (Wikipédia)](https://fr.wikipedia.org/wiki/Injection_SQL)
* [Requêtes préparées SQL (OpenClassrooms)](https://openclassrooms.com/fr/courses/1959476-administrez-vos-bases-de-donnees-avec-mysql/1971264-requetes-preparees)
* [Documentation PDO (php.net)](https://www.php.net/manual/en/book.pdo.php)
* [Requêtes préparées avec PDO (php.net)](https://www.php.net/manual/fr/pdo.prepared-statements.php)
* [Live coding PDO (YouTube)](https://www.youtube.com/watch?v=Rh7mXaZl1oc)

### Sessions et cookies

* [Cookies et sessions en PHP (pierre-giraud.com)](https://www.pierre-giraud.com/php-mysql-apprendre-coder-cours/cookie-creation-gestion/)

### Développement mobile

* [Natif, hybride ou PWA : choisir sa technologie mobile (thetribe.io)](https://thetribe.io/native-hybride-progressive-web-app-choix-techno-mobile/)

### Ressources avancées

* [Démarrer avec Laravel — Laracasts (EN)](https://laracasts.com/series/laravel-5-fundamentals)
