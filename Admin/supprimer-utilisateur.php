<?php
session_start();

// Vérifier si l'utilisateur est connecté et s'il est admin
if ($_SESSION["login"] == "false" || $_SESSION["is_admin"] != 1) {
    header("Location: /"); // Redirige vers la page principale
    exit; // Arrêter l'exécution du script après la redirection
}

// Vérifier si l'ID de l'utilisateur à supprimer est passé dans l'URL
if (!isset($_GET['id'])) {
    echo "ID de l'utilisateur non spécifié.";
    exit;
}

// Connexion à la base de données
$servername = "localhost";
$username_mysql = "root";
$password_mysql = "";
$dbname = "artexpo";

$conn = new mysqli($servername, $username_mysql, $password_mysql, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Préparer la requête SQL pour supprimer l'utilisateur
$user_id = intval($_GET['id']);
$sql = "DELETE FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Erreur de préparation de la requête : " . $conn->error);
}

$stmt->bind_param("i", $user_id);
if ($stmt->execute()) {
    echo "Utilisateur supprimé avec succès.";
} else {
    echo "Erreur lors de la suppression de l'utilisateur : " . $stmt->error;
}

// Fermer la connexion à la base de données
$stmt->close();
$conn->close();

// Rediriger vers la page de gestion des utilisateurs après la suppression
header("Location: gestion-utilisateurs.php");
exit;
?>
