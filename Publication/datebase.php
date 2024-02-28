<?php
// Paramètres de connexion à la base de données
$servername = "localhost";
$username_mysql = "root"; // Nom d'utilisateur MySQL
$password_mysql = ""; // Mot de passe MySQL
$dbname = "artexpo";

// Connexion à la base de données avec PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Définition du mode d'erreur PDO à exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // En cas d'erreur de connexion, afficher l'erreur
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>