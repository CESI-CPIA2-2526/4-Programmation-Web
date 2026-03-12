<?php
require_once __DIR__ . '/../config/db.php';

class Canard
{
    private PDO $pdo;

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function getAll(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM canard ORDER BY nom');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): array|false
    {
        $stmt = $this->pdo->prepare('SELECT * FROM canard WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function ajouter(string $nom, string $type, string $etat): void
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO canard (nom, type, etat) VALUES (?, ?, ?)'
        );
        $stmt->execute([$nom, $type, $etat]);
    }
}
