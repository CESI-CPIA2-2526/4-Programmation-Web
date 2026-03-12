<?php
require_once __DIR__ . '/../models/Etudiant.php';

class EtudiantController
{
    private Etudiant $model;

    public function __construct()
    {
        $this->model = new Etudiant();
    }

    public function liste(): void
    {
        $etudiants = $this->model->getAll();
        require __DIR__ . '/../views/etudiants/liste.php';
    }

    public function ajouter(): void
    {
        $erreur = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // trim() sur chaque champ texte pour éviter les valeurs composées uniquement d'espaces.
            $num_carte = trim($_POST['num_carte'] ?? '');
            $nom       = trim($_POST['nom']       ?? '');
            $prenom    = trim($_POST['prenom']    ?? '');
            $email     = trim($_POST['email']     ?? '');

            if (!$num_carte || !$nom || !$prenom || !$email) {
                $erreur = 'Tous les champs sont obligatoires.';
            } else {
                try {
                    $this->model->ajouter($num_carte, $nom, $prenom, $email);
                    header('Location: index.php?page=etudiants');
                    exit;
                } catch (PDOException $e) {
                    // Si num_carte ou email viole une contrainte UNIQUE ou PRIMARY KEY,
                    // PDO lève une exception qu'on intercepte ici pour afficher un message clair.
                    // On ne ré-affiche pas $e->getMessage() : il peut contenir des infos sensibles.
                    $erreur = 'Ce numéro de carte ou cet email est déjà utilisé.';
                }
            }
        }

        require __DIR__ . '/../views/etudiants/ajouter.php';
    }
}
