# Canardothèque

Application de gestion d'inventaire et de prêts de canards pour le Club Coin-Coin.

## Lancement du projet

1. Créer la base de données et importer le schéma :
   ```bash
   mysql -u root -p < database.sql
   ```
2. Vérifier les identifiants dans `config/db.php` (par défaut : `root` / pas de mot de passe).
3. Placer le dossier dans le répertoire de votre serveur local (ex. `htdocs/` ou `www/`).
4. Accéder à l'application : [http://localhost/canardotheque/](http://localhost/canardotheque/)

## Fonctionnalités implémentées

- Consulter la liste des canards avec leur état
- Ajouter un nouveau canard (nom, type, état initial)
- Consulter la liste des étudiants inscrits
- Inscrire un nouvel étudiant
- Emprunter un canard disponible ("Dans la mare") en l'associant à un étudiant et une date de retour
- Mise à jour automatique de l'état du canard vers "En vadrouille" lors d'un emprunt (transaction SQL)
- Protection contre les injections SQL (requêtes préparées PDO)
- Protection XSS (`htmlspecialchars` sur toutes les données affichées)

## Ce qui ne fonctionne pas / non implémenté

- Retour d'un canard emprunté (changement d'état "En vadrouille" → "Dans la mare")
- Historique des emprunts par étudiant ou par canard
- Authentification
