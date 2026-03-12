<?php
// Le contrôleur dépend du modèle : on l'importe ici.
require_once __DIR__ . '/../models/Canard.php';

// Le contrôleur fait le lien entre les données (Model) et l'affichage (View).
// Il ne contient pas de SQL et ne génère pas de HTML.
class CanardController
{
    // Le modèle est stocké en propriété pour être réutilisable dans toutes les méthodes.
    private Canard $model;

    public function __construct()
    {
        $this->model = new Canard();
    }

    // Affiche la liste de tous les canards.
    public function liste(): void
    {
        // On délègue la requête SQL au modèle.
        $canards = $this->model->getAll();

        // On passe la main à la vue. La variable $canards sera accessible dans liste.php
        // car require inclut le fichier dans le même scope.
        require __DIR__ . '/../views/canards/liste.php';
    }

    // Affiche le formulaire (GET) et traite sa soumission (POST).
    public function ajouter(): void
    {
        // Variable transmise à la vue pour afficher un éventuel message d'erreur.
        $erreur = '';

        // On ne traite les données que si le formulaire a été soumis.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // trim() supprime les espaces superflus en début/fin de chaîne.
            $nom  = trim($_POST['nom']  ?? '');
            $type = $_POST['type'] ?? '';
            $etat = $_POST['etat'] ?? 'Dans la mare';

            // Validation minimale côté serveur : on ne fait jamais confiance au client seul.
            if ($nom === '' || $type === '') {
                $erreur = 'Le nom et le type sont obligatoires.';
            } else {
                $this->model->ajouter($nom, $type, $etat);

                // Redirection après un POST réussi : évite la re-soumission du formulaire
                // si l'utilisateur rafraîchit la page (pattern Post/Redirect/Get).
                header('Location: index.php?page=canards');
                exit;
            }
        }

        // On arrive ici dans deux cas : requête GET (premier affichage) ou POST invalide.
        require __DIR__ . '/../views/canards/ajouter.php';
    }
}
