<?php
require_once __DIR__ . '/../config/db.php';

class Etudiant
{
    private PDO $pdo;

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }

    // Retourne tous les étudiants triés par nom puis prénom.
    public function getAll(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM etudiant ORDER BY nom, prenom');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Insère un nouvel étudiant.
    // Si num_carte ou email viole une contrainte UNIQUE/PRIMARY KEY,
    // PDO lève une PDOException que le contrôleur se charge d'intercepter.
    public function ajouter(string $num_carte, string $nom, string $prenom, string $email): void
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO etudiant (num_carte, nom, prenom, email) VALUES (?, ?, ?, ?)'
        );
        $stmt->execute([$num_carte, $nom, $prenom, $email]);
    }
}
