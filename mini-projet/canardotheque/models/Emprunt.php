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

    public function creer(int $canard_id, string $etudiant_id, string $date_pret, string $date_retour_prevue): void
    {
        $this->pdo->beginTransaction();

        try {
            $stmt = $this->pdo->prepare(
                'INSERT INTO emprunt (canard_id, etudiant_id, date_pret, date_retour_prevue) VALUES (?, ?, ?, ?)'
            );
            $stmt->execute([$canard_id, $etudiant_id, $date_pret, $date_retour_prevue]);

            $stmt = $this->pdo->prepare("UPDATE canard SET etat = 'En vadrouille' WHERE id = ?");
            $stmt->execute([$canard_id]);

            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }
}
