<?php
require_once __DIR__ . '/../config/db.php';

class Emprunt
{
    private PDO $pdo;

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }

    // Crée un emprunt et met à jour l'état du canard en une seule opération atomique.
    public function creer(int $canard_id, string $etudiant_id, string $date_pret, string $date_retour_prevue): void
    {
        // Une transaction regroupe plusieurs requêtes en un bloc tout-ou-rien :
        // soit les deux réussissent, soit aucune n'est appliquée.
        // Ici c'est essentiel : on ne veut pas qu'un emprunt soit enregistré
        // sans que l'état du canard soit mis à jour (et vice-versa).
        $this->pdo->beginTransaction();

        try {
            $stmt = $this->pdo->prepare(
                'INSERT INTO emprunt (canard_id, etudiant_id, date_pret, date_retour_prevue) VALUES (?, ?, ?, ?)'
            );
            $stmt->execute([$canard_id, $etudiant_id, $date_pret, $date_retour_prevue]);

            // Règle métier : le canard passe automatiquement à "En vadrouille".
            $stmt = $this->pdo->prepare("UPDATE canard SET etat = 'En vadrouille' WHERE id = ?");
            $stmt->execute([$canard_id]);

            // Si on arrive ici sans exception, on valide définitivement les deux requêtes.
            $this->pdo->commit();
        } catch (Exception $e) {
            // En cas d'erreur, on annule tout : la base revient à son état initial.
            $this->pdo->rollBack();
            // On remonte l'exception pour que le contrôleur puisse la gérer si besoin.
            throw $e;
        }
    }
}
