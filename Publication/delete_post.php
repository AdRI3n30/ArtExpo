<?php
// Inclusion du fichier de connexion à la base de données
require_once 'database.php';

if(isset($_POST['delete'])) {
    // Récupération de l'identifiant de la publication à supprimer
    $post_id = $_POST['post_id'];

    // Requête SQL pour supprimer la publication de la base de données
    $sql = "DELETE FROM posts WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $post_id);
    $stmt->execute();

    // Redirection vers la page d'affichage des publications
    header("Location: display_posts.php");
    exit();
}
?>