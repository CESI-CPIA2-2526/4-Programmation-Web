<?php
$page   = $_GET['page']   ?? 'canards';
$action = $_GET['action'] ?? 'liste';

switch ($page) {
    case 'etudiants':
        require_once 'controllers/EtudiantController.php';
        $controller = new EtudiantController();
        break;
    case 'emprunts':
        require_once 'controllers/EmpruntController.php';
        $controller = new EmpruntController();
        $action = 'creer';
        break;
    default:
        require_once 'controllers/CanardController.php';
        $controller = new CanardController();
}

if (method_exists($controller, $action)) {
    $controller->$action();
} else {
    $controller->liste();
}
