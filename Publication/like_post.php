<?php
// Inclusion du fichier de connexion à la base de données
require_once 'database.php';

// Démarrage de la session
session_start();

// Vérification si l'utilisateur est connecté
if(isset($_SESSION['user_id'])) {
    // Vérifier si le formulaire de like a été soumis
    if(isset($_POST['like'], $_POST['post_id'])) {
        // Récupérer l'identifiant du post et l'identifiant de l'utilisateur
        $post_id = $_POST['post_id'];
        $user_id = $_SESSION['user_id'];

        // Vérifier si l'utilisateur a déjà aimé le post
        $sql_check_like = "SELECT * FROM likes WHERE post_id = ? AND user_id = ?";
        $stmt_check_like = $mysqli->prepare($sql_check_like);
        $stmt_check_like->bind_param("ii", $post_id, $user_id);
        $stmt_check_like->execute();
        $result_check_like = $stmt_check_like->get_result();

        if($result_check_like->num_rows == 0) {
            // Ajouter le like dans la base de données
            $sql_add_like = "INSERT INTO likes (post_id, user_id) VALUES (?, ?)";
            $stmt_add_like = $mysqli->prepare($sql_add_like);
            $stmt_add_like->bind_param("ii", $post_id, $user_id);
            $stmt_add_like->execute();

            // Mettre à jour le compteur de likes du post dans la table posts
            $sql_update_likes = "UPDATE posts SET likes = likes + 1 WHERE id = ?";
            $stmt_update_likes = $mysqli->prepare($sql_update_likes);
            $stmt_update_likes->bind_param("i", $post_id);
            $stmt_update_likes->execute();
        } else {
            // Supprimer le like de la base de données
            $sql_remove_like = "DELETE FROM likes WHERE post_id = ? AND user_id = ?";
            $stmt_remove_like = $mysqli->prepare($sql_remove_like);
            $stmt_remove_like->bind_param("ii", $post_id, $user_id);
            $stmt_remove_like->execute();

            // Mettre à jour le compteur de likes du post dans la table posts
            $sql_update_likes = "UPDATE posts SET likes = likes - 1 WHERE id = ?";
            $stmt_update_likes = $mysqli->prepare($sql_update_likes);
            $stmt_update_likes->bind_param("i", $post_id);
            $stmt_update_likes->execute();
        }

        // Redirection vers la page précédente
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        // Redirection vers la page précédente si le formulaire de like n'a pas été soumis
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
} else {
    // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: login.php");
    exit();
}

?>