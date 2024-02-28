<?php
// Paramètres de connexion à la base de données
$servername = "localhost";
$username_mysql = "root"; // Nom d'utilisateur MySQL
$password_mysql = ""; // Mot de passe MySQL
$dbname = "artexpo";

// Connexion à la base de données avec PDO
$mysqli = new mysqli($servername, $username_mysql, $password_mysql, $dbname);
// Définition du mode d'erreur PDO à exception
// Vérifier la connexion
if ($mysqli->connect_error) {
    die("Erreur de connexion à la base de données : " . $mysqli->connect_error);
}

// Définir le jeu de caractères à utf8
$mysqli->set_charset("utf8");
?>