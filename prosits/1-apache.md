# Prosit 1 - Apache et HTTP

---

## Contexte

Le client est satisfait des modifications effectuees par l'agence Web4All concernant le formulaire pour postuler a une offre.

Il faut maintenant passer a la vitesse superieure : l'equipe doit rapidement configurer un environnement de developpement local efficace et securise.

---

## Scenario

Jean-Marc reunit l'equipe et expose les enjeux.

**Jean-Marc :** « Bonjour a tous. Nous avons un delai tres court pour mettre en place notre environnement de developpement. Rodriguez, peux-tu nous expliquer comment configurer notre serveur Apache local avec plusieurs hotes virtuels ? »

**Rodriguez (Admin Sys/DevOps) :** « Bien sur. Nous allons definir le repertoire racine du site principal en utilisant la directive DocumentRoot d'Apache. Cela est crucial pour la securite, car nous devons nous assurer que seuls les fichiers necessaires sont accessibles publiquement. »

**Estelle (Architecte logiciel) :** « En plus de cela, je recommande de configurer deux hotes virtuels distincts : un pour le site principal (cesi-site.local) et un autre pour nos ressources statiques (cesi-static.local) comme les fichiers JS et les images. Cela ameliorera les performances et facilitera la gestion des fichiers. »

**Dominique (Dev Frontend) :** « Et comment allons-nous gerer les erreurs, surveiller les requetes, et deployer le frontend ? »

**Rodriguez :** « Pour le frontend, nous devons migrer tous les fichiers qui ne sont pas encore sur le serveur afin de garantir un deploiement complet et fonctionnel. Ensuite, nous utiliserons les journaux (logs) d'Apache pour suivre les requetes et identifier les erreurs grace aux codes d'etat HTTP comme les 404 ou 500. De plus, nous configurerons les en-tetes HTTP pour ameliorer la communication entre le navigateur et le serveur. »

**Sami (Dev Backend) :** « Qu'en est-il des methodes HTTP, des redirections et des outils de diagnostic ? »

**Rodriguez :** « Nous devons maitriser les differentes methodes HTTP comme GET et POST pour gerer les interactions serveur-client. Pour les redirections, nous utiliserons des fichiers .htaccess afin de configurer les redirections necessaires sans modifier la configuration principale d'Apache. Concernant le diagnostic, nous utiliserons les outils de developpement integres au navigateur. L'onglet Network permet d'inspecter les requetes HTTP, leurs reponses, et de deboguer efficacement. »

**Jean-Marc :** « Parfait. N'oublions pas d'implementer HTTPS pour securiser les communications, meme en local. Rodriguez, assure-toi que tout soit pret dans les deux jours et demi impartis. Pensez egalement a documenter dans le livrable la migration complete du frontend et l'utilisation des outils de diagnostic pour les requetes HTTP. »

---

## Mots-cles

| Terme | Description |
|-------|-------------|
| DocumentRoot | Directive Apache definissant le repertoire racine du site |
| Virtual Host (vhost) | Configuration permettant d'heberger plusieurs sites sur un serveur |
| .htaccess | Fichier de configuration decentralise pour Apache |
| Logs Apache | Journaux d'acces et d'erreurs du serveur |
| Codes HTTP | Codes de statut des reponses HTTP (200, 404, 500...) |
| En-tetes HTTP | Metadonnees des requetes et reponses HTTP |
| Methodes HTTP | GET, POST, PUT, DELETE... |
| HTTPS | Protocole HTTP securise avec certificat SSL/TLS |

---

## Livrables attendus

| Livrable | Description |
|----------|-------------|
| Configuration Apache | Fichiers de configuration des vhosts |
| Migration frontend | Deploiement complet des fichiers sur le serveur |
| Documentation | Utilisation des outils de diagnostic HTTP |
| HTTPS local | Configuration du certificat SSL en local |

---

## Ressources

### Installation LAMP

| Ressource | Lien |
|-----------|------|
| Guide d'installation LAMP sous Linux Mint | `Installation de LAMP sous Linux Mint - JGT v1.3.pdf` |

### Documentation Apache

| Ressource | Lien |
|-----------|------|
| Documentation officielle Apache | [httpd.apache.org/docs](https://httpd.apache.org/docs/) |
| Guide sur les hotes virtuels | [httpd.apache.org/docs/current/vhosts](https://httpd.apache.org/docs/current/vhosts/) |
| Guide sur les fichiers .htaccess | [httpd.apache.org/docs/current/howto/htaccess](https://httpd.apache.org/docs/current/howto/htaccess.html) |

### Protocole HTTP

| Ressource | Lien |
|-----------|------|
| Comprendre les en-tetes HTTP | [MDN - HTTP Headers](https://developer.mozilla.org/fr/docs/Web/HTTP/Headers) |
| Methodes HTTP | [MDN - HTTP Methods](https://developer.mozilla.org/fr/docs/Web/HTTP/Methods) |
| Codes d'etat HTTP | [MDN - HTTP Status](https://developer.mozilla.org/fr/docs/Web/HTTP/Status) |

### HTTPS et securite

| Ressource | Lien |
|-----------|------|
| Introduction a Let's Encrypt | [letsencrypt.org/fr/docs](https://letsencrypt.org/fr/docs/) |
| Securiser Apache avec Let's Encrypt | [DigitalOcean - Tutorial](https://www.digitalocean.com/community/tutorials/how-to-secure-apache-with-let-s-encrypt-on-ubuntu-20-04-fr) |
