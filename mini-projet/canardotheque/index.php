<?php
/**
 * Point d'entrée unique de l'application.
 *
 * Toutes les URL passent par ce fichier (ex: index.php?page=canards&action=ajouter).
 * C'est le principe du "front controller" : un seul fichier reçoit toutes les requêtes
 * et décide quoi faire en fonction des paramètres GET.
 */

// On lit le paramètre "page" dans l'URL.
// Si absent (première visite), on affiche les canards par défaut.
// L'opérateur ?? est le "null coalescing" : il retourne la valeur de droite si celle de gauche est null.
$page   = $_GET['page']   ?? 'canards';

// On lit le paramètre "action" dans l'URL.
// Si absent, l'action par défaut est d'afficher la liste.
$action = $_GET['action'] ?? 'liste';

// En fonction de la page demandée, on charge le bon contrôleur.
// require_once charge le fichier une seule fois (évite les doublons de définition de classe).
switch ($page) {
    case 'etudiants':
        require_once 'controllers/EtudiantController.php';
        $controller = new EtudiantController();
        break;

    case 'emprunts':
        require_once 'controllers/EmpruntController.php';
        $controller = new EmpruntController();
        // La seule action possible pour les emprunts est "creer".
        // On écrase $action pour éviter qu'une valeur inattendue dans l'URL ne cause une erreur.
        $action = 'creer';
        break;

    default:
        // Si "page" est inconnu ou vaut "canards", on charge le contrôleur des canards.
        require_once 'controllers/CanardController.php';
        $controller = new CanardController();
}

// On vérifie que la méthode demandée existe bien dans le contrôleur sélectionné.
// C'est une sécurité : sans ce contrôle, un utilisateur pourrait appeler n'importe quelle
// méthode en manipulant l'URL (ex: ?action=__destruct).
if (method_exists($controller, $action)) {
    // Appel dynamique de la méthode : $controller->liste(), $controller->ajouter(), etc.
    $controller->$action();
} else {
    // Action inconnue : on replie sur la liste par défaut.
    $controller->liste();
}
