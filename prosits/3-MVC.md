# Boucle PBL : MVC - Composer - Moteur de template

**Type :** Prosit / Workshop

## Objectifs d'apprentissage

### Architecture MVC

* **[1]** Rappeler les apports de l'architecture MVC dans le développement d'une application.
* **[2]** Expliquer le rôle des composants de l'architecture MVC et leurs interactions.
* **[4]** Mettre en œuvre l'architecture MVC pour développer une application PHP complexe.

### Moteur de template

* **[1]** Définir ce qu'est un moteur de template.
* **[2]** Citer les fonctionnalités proposées par un moteur de template.
* **[3]** Utiliser un moteur de template pour développer une application PHP.
* **[4]** Intégrer un moteur de template dans une architecture MVC.

### Gestionnaire de dépendances

* **[2]** Expliquer le rôle d'un gestionnaire de dépendances.
* **[2]** Reconnaitre les éléments qui constituent un projet géré par Composer : `composer.json`, répertoire `vendors`...
* **[3]** Utiliser les commandes de Composer pour installer, mettre à jour et supprimer des dépendances.

---

## Sujet : Énoncé

### Un peu de structure, que diable !!!

*Ce matin dans la salle de réunion de Web4all...*

**Jean-Marc :**

> « Bonjour à tous. Merci d’être là. Le projet avance bien : la page de dépôt des CV et l’affichage des entreprises fonctionnent. Mais on a un problème de structure : Dominique et Sami se marchent dessus, car tout est mélangé dans un seul fichier PHP. Estelle, peux-tu nous donner ton avis sur la situation actuelle ? »

**Estelle :**

> « Le code est devenu ingérable. Les fonctionnalités sont entremêlées, ce qui complique le débogage et les mises à jour. Il faut absolument séparer les responsabilités. »

**Dominique :**

> « Exactement ! Je perds un temps fou à démêler le PHP du HTML… Et si on devait modifier le header, il faudrait le faire dans chaque fichier ! »

**Jean-Marc :**

> « C’est pourquoi je propose d’adopter le modèle MVC pour clarifier l’architecture. Sami, tu géreras le routage des requêtes vers les contrôleurs. Dominique, pour les vues, un moteur de template serait idéal : il séparera la logique de présentation du HTML et permettra de réutiliser des fragments comme le header ou le footer, sans duplication. »

**Estelle :**

> « Bonne idée ! Le modèle MVC nous aidera à gérer les données, l'interface utilisateur et la logique de l'application de manière indépendante. »

**Jean-Marc :**

> « Par contre, les moteurs de template ne sont pas directement inclus dans le langage PHP. Il va falloir utiliser des dépendances tierces... »

**Sami :**

> « Pour gérer les dépendances de notre projet, on pourrait utiliser Composer. En plus, le fichier `composer.json` nous aidera à assurer la maintenabilité du projet. »

**Estelle :**

> « Grâce à Composer nous pourrons aussi structurer et standardiser l'arborescence du projet. »

**Sami :**

> « Sans parler de l'autoloading qui va grandement me faciliter la tâche ! Pour le moteur de template, je suggère que l'on utilise Twig qui est l'un des plus utilisés. »

**Jean-Marc :**

> « Je vous propose que l'on retravaille les fonctionnalités "Postuler à une offre" et "Affichage de la liste des entreprises". Mais il ne faudra pas trainer, car le backlog n'attend pas !
> Estelle, peux-tu préparer la structure de base de notre application en suivant le modèle MVC ?
> Sami, je te laisse configurer Composer et installer Twig.
> Avec Dominique, vous pourrez ensuite restructurer le code. Et Dominique, utilise bien ces fragments et l’héritage de templates pour factoriser le code. On fait le point dans deux jours ? »

**Estelle, Sami et Dominique :**

> « D'accord ! »

---

## Ressources pour les étudiants

### Le modèle MVC

* Adoptez une architecture MVC en PHP (OpenClassrooms)
* Créer un routeur (OpenClassrooms)
* Tutoriel PHP : créer un routeur PHP (Grafikart) *[Ressource avancée]*

### Le moteur de template

* Documentation du moteur de template Twig
* Dynamisez vos vues à l’aide de Twig (OpenClassrooms)

### Gestionnaire de dépendances (Composer)

* Documentation de Composer
* Guide d'installation de Composer
* Utiliser des librairies tierces (Grafikart)

### Complément sur la structure d'un projet

* Un exemple de projet PHP qui utilise Composer