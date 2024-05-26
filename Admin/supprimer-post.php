<?php
session_start();

// Vérifier si l'utilisateur est connecté et s'il est administrateur
if (!isset($_SESSION["login"]) || $_SESSION["login"] == "false" || $_SESSION["is_admin"] != 1) {
    header("Location: /");
    exit;
}

// Vérifier si l'ID du post est passé en paramètre
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID du post non spécifié.";
    exit;
}

// Récupérer l'ID du post à supprimer
$post_id = $_GET['id'];

// Connexion à la base de données
$servername = "localhost";
$username_mysql = "root"; // Nom d'utilisateur MySQL
$password_mysql = ""; // Mot de passe MySQL
$dbname = "artexpo";

$conn = new mysqli($servername, $username_mysql, $password_mysql, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Préparer et exécuter la requête SQL pour supprimer le post
$stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
$stmt->bind_param("i", $post_id);

if ($stmt->execute()) {
    // Rediriger vers la page de gestion des posts avec un message de succès
    header("Location: gestion-posts.php?message=Post supprimé avec succès.");
} else {
    echo "Erreur lors de la suppression du post.";
}

// Fermer la connexion à la base de données
$stmt->close();
$conn->close();
?>