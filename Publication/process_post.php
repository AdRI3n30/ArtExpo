<?php
// Inclusion du fichier de connexion à la base de données
require_once 'database.php';

if(isset($_POST['submit'])) {
    // Récupération des données du formulaire
    $content = $_POST['content'];

    // Requête SQL pour insérer la publication dans la base de données
    $sql = "INSERT INTO posts (content) VALUES (?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$content]);

    // Redirection vers la page d'affichage des publications
    header("Location: display_posts.php");
    exit();
}
?>