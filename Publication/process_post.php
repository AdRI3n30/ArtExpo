<?php
// Inclusion du fichier de connexion à la base de données
require_once 'database.php';

// Démarrage de la session
session_start();

// Vérification si l'utilisateur est connecté
if(isset($_SESSION['user_id'])) {
    // Récupération de l'ID de l'utilisateur à partir de la session
    $user_id = $_SESSION['user_id'];

    if(isset($_POST['submit'])) {
        // Récupération des données du formulaire
        $content = $_POST['content'];

        // Traitement de l'image téléchargée
        $image_path = '';
        if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image_name = $_FILES['image']['name'];
            $image_tmp_name = $_FILES['image']['tmp_name'];
            $image_path = 'uploads/' . $image_name;
            move_uploaded_file($image_tmp_name, $image_path);
        }

        // Requête SQL pour insérer la publication dans la base de données
        $sql = "INSERT INTO posts (user_id, content, image_path) VALUES (?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("iss", $user_id, $content, $image_path);
        $stmt->execute();

        // Redirection vers la page d'affichage des publications
        header("Location: display_posts.php");
        exit();
    }
} else {
    // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: login.php");
    exit();
}
?>