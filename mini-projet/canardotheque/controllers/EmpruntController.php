<?php
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

    public function creer(): void
    {
        $erreur = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $canard_id          = (int)($_POST['canard_id']          ?? 0);
            $etudiant_id        = trim($_POST['etudiant_id']         ?? '');
            $date_retour_prevue = $_POST['date_retour_prevue']       ?? '';

            if (!$canard_id || !$etudiant_id || !$date_retour_prevue) {
                $erreur = 'Tous les champs sont obligatoires.';
            } else {
                $this->model->creer($canard_id, $etudiant_id, date('Y-m-d'), $date_retour_prevue);
                header('Location: index.php?page=canards');
                exit;
            }
        }

        $canard_id = (int)($_GET['canard_id'] ?? 0);
        $canard    = $this->canardModel->getById($canard_id);
        $etudiants = $this->etudiantModel->getAll();

        if (!$canard || $canard['etat'] !== 'Dans la mare') {
            header('Location: index.php?page=canards');
            exit;
        }

        require __DIR__ . '/../views/emprunts/creer.php';
    }
}
