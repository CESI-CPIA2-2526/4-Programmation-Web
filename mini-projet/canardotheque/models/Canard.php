<?php
// Le modèle a besoin de la connexion PDO définie dans db.php.
require_once __DIR__ . '/../config/db.php';

// Le modèle est la seule couche autorisée à écrire du SQL.
// Il ne sait pas comment les données seront affichées : c'est le rôle de la vue.
class Canard
{
    private PDO $pdo;

    public function __construct()
    {
        // $pdo est une variable globale créée dans db.php.
        // On la récupère ici pour l'utiliser dans toutes les méthodes de la classe.
        global $pdo;
        $this->pdo = $pdo;
    }

    // Retourne tous les canards triés par nom.
    // query() suffit ici : la requête ne contient aucune donnée externe, donc pas de risque d'injection.
    public function getAll(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM canard ORDER BY nom');
        // fetchAll retourne un tableau de tableaux associatifs (clé = nom de colonne).
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Retourne un seul canard par son identifiant, ou false s'il n'existe pas.
    // On utilise prepare() car $id vient de l'extérieur (URL).
    public function getById(int $id): array|false
    {
        $stmt = $this->pdo->prepare('SELECT * FROM canard WHERE id = ?');
        // Le ? est remplacé de façon sécurisée par PDO : impossible d'injecter du SQL.
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Insère un nouveau canard en base.
    // Les trois ? correspondent dans l'ordre au tableau passé à execute().
    public function ajouter(string $nom, string $type, string $etat): void
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO canard (nom, type, etat) VALUES (?, ?, ?)'
        );
        $stmt->execute([$nom, $type, $etat]);
    }
}
