<?php
// config/database.php

// Paramètres de connexion (à adapter à votre environnement)
$host = 'localhost';
$db   = 'technipolesupvalor';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

// Construction du Data Source Name (DSN)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    // Création de l’objet PDO
    $pdo = new PDO($dsn, $user, $pass);

    // Configuration pour lancer une exception en cas d’erreur SQL
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // (Optionnel) Gestion des retours de requêtes en tableau associatif
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // En cas d’erreur de connexion
    echo 'Erreur de connexion : ' . $e->getMessage();
    exit();
}
