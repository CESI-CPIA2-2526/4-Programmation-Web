<?php
$dsn     = 'mysql:host=localhost;dbname=canardotheque;charset=utf8';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
    $pdo = new PDO($dsn, 'root', '', $options);
} catch (PDOException $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}
