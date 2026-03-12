<?php
// Ce contrôleur a besoin de trois modèles : l'emprunt lui-même, le canard et l'étudiant.
require_once __DIR__ . '/../models/Emprunt.php';
require_once __DIR__ . '/../models/Canard.php';
require_once __DIR__ . '/../models/Etudiant.php';

class EmpruntController
{
    private Emprunt  $model;
    private Canard   $canardModel;
    private Etudiant $etudiantModel;

    public function __construct()
    {
        $this->model         = new Emprunt();
        $this->canardModel   = new Canard();
        $this->etudiantModel = new Etudiant();
    }

    // Gère à la fois l'affichage du formulaire (GET) et la création de l'emprunt (POST).
    public function creer(): void
    {
        $erreur = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // (int) force le cast en entier : si canard_id est absent ou non numérique, on obtient 0.
            $canard_id          = (int)($_POST['canard_id']        ?? 0);
            $etudiant_id        = trim($_POST['etudiant_id']       ?? '');
            $date_retour_prevue = $_POST['date_retour_prevue']     ?? '';

            if (!$canard_id || !$etudiant_id || !$date_retour_prevue) {
                $erreur = 'Tous les champs sont obligatoires.';
            } else {
                // La date de prêt est toujours aujourd'hui : on la génère côté serveur,
                // pas côté client, pour ne pas pouvoir la falsifier.
                $this->model->creer($canard_id, $etudiant_id, date('Y-m-d'), $date_retour_prevue);
                header('Location: index.php?page=canards');
                exit;
            }
        }

        // On récupère le canard ciblé depuis l'URL (?canard_id=X).
        $canard_id = (int)($_GET['canard_id'] ?? 0);
        $canard    = $this->canardModel->getById($canard_id);
        $etudiants = $this->etudiantModel->getAll();

        // Sécurité : on vérifie que le canard existe et qu'il est bien disponible.
        // Sans ce contrôle, on pourrait emprunter un canard déjà en vadrouille
        // en forgeant l'URL manuellement.
        if (!$canard || $canard['etat'] !== 'Dans la mare') {
            header('Location: index.php?page=canards');
            exit;
        }

        require __DIR__ . '/../views/emprunts/creer.php';
    }
}
