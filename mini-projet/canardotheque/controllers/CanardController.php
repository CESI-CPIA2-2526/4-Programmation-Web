<?php
require_once __DIR__ . '/../models/Canard.php';

class CanardController
{
    private Canard $model;

    public function __construct()
    {
        $this->model = new Canard();
    }

    public function liste(): void
    {
        $canards = $this->model->getAll();
        require __DIR__ . '/../views/canards/liste.php';
    }

    public function ajouter(): void
    {
        $erreur = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom  = trim($_POST['nom']  ?? '');
            $type = $_POST['type'] ?? '';
            $etat = $_POST['etat'] ?? 'Dans la mare';

            if ($nom === '' || $type === '') {
                $erreur = 'Le nom et le type sont obligatoires.';
            } else {
                $this->model->ajouter($nom, $type, $etat);
                header('Location: index.php?page=canards');
                exit;
            }
        }

        require __DIR__ . '/../views/canards/ajouter.php';
    }
}
