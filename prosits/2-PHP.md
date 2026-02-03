# Prosit 2 - PHP : Formulaires, Pagination et POO

---

## Objectifs d'apprentissage

| Niveau | Objectif |
|--------|----------|
| [3] | Coder en PHP en respectant une syntaxe correcte et en maitrisant les principales structures du langage |
| [3] | Manipuler des chaines de caracteres en PHP (quotes simples/doubles, concatenation, fonctions mb* pour UTF-8) |
| [3] | Appliquer les principes de la POO en PHP (classes, objets, heritage, encapsulation) |
| [3] | Manipuler les mecanismes de gestion des entrees utilisateur en PHP (echappement des chaines pour la securite) |
| [3] | Utiliser des techniques avancees de debogage (var_dump) pour identifier et resoudre les problemes |
| [1] | Connaitre les superglobales en PHP pour acceder aux donnees globales et informations serveur |
| [3] | Mettre en place du televersement de fichiers |

---

## Prerequis

| Prerequis | Description |
|-----------|-------------|
| POO | Notions de base (classes, objets) |
| HTTP | Protocole et methodes |
| HTML | Balises FORM |
| Apache | Installation d'un serveur et connaissance du DocumentRoot |

---

## Contexte

L'equipe est a nouveau en reunion apres validation des maquettes et la mise en place de l'infrastructure locale. Sami, en tant que developpeur backend, se charge des taches de dynamisation, avec Dominique qui veille a une bonne integration cote frontend.

Aucune verification cote front n'ayant encore ete mise en place, il va falloir s'assurer que toutes les validations necessaires sont realisees cote back afin de garantir la securite et la conformite des donnees transmises.

---

## Scenario

**Jean-Marc :** « Bonjour a tous ! On a bien avance avec les maquettes. Le client est satisfait, et maintenant, on passe a la dynamisation. Sami, tu vas devoir gerer deux taches importantes cette semaine. »

**Sami :** « Je suis pret, Jean-Marc. De quoi s'agit-il ? »

**Jean-Marc :** « La premiere tache concerne la page "Postuler a une offre". Il faut permettre aux candidats de televerser leur CV. On doit aussi valider les entrees cote back pour garantir que les fichiers envoyes sont conformes et securises. »

**Sami :** « Tres bien, je vais m'en occuper. Je vais reflechir a une solution pour gerer l'envoi des fichiers et m'assurer que tout soit conforme. Il faut par exemple que l'on verifie lors de la reception que la taille du fichier respecte bien la limite de 2 Mo maximum. Je vais aussi verifier les extensions de fichiers autorisees et le type MIME pour eviter tout probleme de securite. »

**Jean-Marc :** « OK. Comme aucune validation n'est encore mise en place cote client, il faudra s'assurer cote serveur que le fichier est bien selectionne et que le formulaire ne peut pas etre soumis avec des donnees incorrectes. »

**Sami :** « D'accord. Je vais aussi penser a des techniques pour echapper les donnees avant de les afficher afin d'eviter les failles XSS. Et je veillerai a valider les champs pour eviter toute soumission invalide. Pour rendre le code plus clair et reutilisable, je pourrais creer une classe pour gerer l'upload des fichiers avec des methodes dediees a la validation et au deplacement des fichiers. »

**Jean-Marc :** « Parfait. La deuxieme tache concerne la "Liste des entreprises". Actuellement, on affiche tout en une seule fois, et cela devient difficile a lire. Il faudrait mettre en place un systeme pour afficher les entreprises par page, avec une navigation simple pour passer d'une page a une autre. L'objectif est d'afficher 10 entreprises par page. »

**Sami :** « Compris. Je vais reflechir a un moyen de diviser les entreprises en plusieurs pages tout en rendant la navigation fluide pour les utilisateurs. Par exemple, on pourrait utiliser des techniques comme le decoupage des donnees avec array_slice et gerer les pages avec des parametres passes dans l'URL. On pourrait egalement creer une classe Pagination qui prendrait en entree la liste des entreprises et le nombre d'elements par page, et fournirait des methodes pour recuperer les elements d'une page et generer les liens de navigation. »

**Jean-Marc :** « Tres bien. Assure-toi egalement de securiser les donnees manipulees pour eviter tout probleme lie aux entrees utilisateur. »

**Dominique :** « Pour le frontend, je vais m'occuper de l'aspect visuel de la pagination. Les boutons "Precedent" et "Suivant" devront etre bien visibles et adaptes au design general. Sami, je veillerai a rendre la navigation entre les pages intuitive et fluide. »

**Sami :** « Parfait, je vais m'assurer que tout fonctionne correctement et tester la pagination pour verifier que chaque page contient bien 10 entreprises. »

**Jean-Marc :** « Excellente coordination. N'oubliez pas de respecter les bonnes pratiques de securite, notamment l'echappement des donnees, et de mentionner les mentions legales sur la page. »

**Dominique :** « Une fois que tout sera pret, je testerai avec toi pour m'assurer que le formulaire et la pagination fonctionnent parfaitement. »

**Jean-Marc :** « Merci, equipe ! Allez, au travail ! »

---

## Mots-cles

| Terme | Description |
|-------|-------------|
| $_FILES | Superglobale pour gerer les fichiers televerses |
| $_GET / $_POST | Superglobales pour les donnees de formulaire |
| htmlspecialchars() | Fonction d'echappement contre les failles XSS |
| array_slice() | Fonction pour decouper un tableau (pagination) |
| Type MIME | Type de contenu d'un fichier (ex: application/pdf) |
| POO | Programmation Orientee Objet |
| Encapsulation | Principe de protection des donnees d'une classe |

---

## Livrables attendus

| Livrable | Description |
|----------|-------------|
| Formulaire d'upload | Page "Postuler a une offre" avec televersement de CV |
| Classe Upload | Classe PHP pour gerer l'upload avec validation |
| Pagination | Systeme d'affichage par page (10 elements/page) |
| Classe Pagination | Classe PHP pour gerer la pagination |
| Securite | Validation et echappement des donnees |

---

## Ressources

### Documentation principale

| Ressource | Lien |
|-----------|------|
| Documentation PHP officielle | [php.net/manual/fr](https://www.php.net/manual/fr/) |
| Sandbox PHP en ligne | [sandbox.onlinephpfunctions.com](https://sandbox.onlinephpfunctions.com) |
| Tutoriels PHP (Grafikart) | [grafikart.fr/tutoriels/php](https://www.grafikart.fr/tutoriels/php) |

### Chaines et encodage

| Ressource | Lien |
|-----------|------|
| Manipulation des chaines | [php.net - strings](https://www.php.net/manual/fr/language.types.string.php) |
| Comprendre les encodages | [sdz.tdct.org - encodages](http://sdz.tdct.org/sdz/comprendre-les-encodages.html) |
| Transtypage | [php.net - type-juggling](https://www.php.net/manual/fr/language.types.type-juggling.php) |

### Upload et pagination

| Ressource | Lien |
|-----------|------|
| Gestion des fichiers uploades | [php.net - file-upload](https://www.php.net/manual/fr/features.file-upload.php) |
| Creer une pagination | [grafikart.fr - pagination](https://grafikart.fr/tutoriels/pagination-php-51) |

### Pour aller plus loin

| Ressource | Lien |
|-----------|------|
| Fonctions anonymes / Callbacks | [blog.lepine.pro - callbacks](http://blog.lepine.pro/php/tour-dhorizon-des-callbacks-en-php) |
| Namespaces PHP | [php.net - namespaces](https://www.php.net/manual/fr/language.namespaces.php) |
| Convention PSR-12 | [php-fig.org - psr-12](https://www.php-fig.org/psr/psr-12/) |
| Langages interpretes vs compiles | [france-ioi.org](http://www.france-ioi.org/algo/course.php?idChapter=561&idCourse=2368) |

### Bibliographie

| Ouvrage | Auteur |
|---------|--------|
| Coder proprement | Robert C. Martin (Editions Pearson) |
