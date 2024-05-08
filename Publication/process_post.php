<?php
// Inclusion du fichier de connexion à la base de données
require_once 'database.php';

// Démarrage de la session
session_start();

// Vérification si l'utilisateur est connecté
if(isset($_SESSION['user_id'])) {
    // Récupération de l'ID de l'utilisateur à partir de la session
    $user_id = $_SESSION['user_id'];

    // Requête SQL pour récupérer les informations de l'utilisateur
    $sql_user = "SELECT username, is_admin FROM users WHERE id = ?";
    $stmt_user = $mysqli->prepare($sql_user);

    // Vérifier si la préparation de la requête a échoué
    if(!$stmt_user) {
        die("Erreur de préparation de la requête: " . $mysqli->error);
    }

    $stmt_user->bind_param("i", $user_id);

    // Exécution de la requête
    if(!$stmt_user->execute()) {
        die("Erreur lors de l'exécution de la requête: " . $stmt_user->error);
    }

    $result_user = $stmt_user->get_result();

    // Vérification si la requête a réussi
    if ($result_user) {
        // Récupération des données de l'utilisateur
        $row_user = $result_user->fetch_assoc();
        $username = $row_user['username']; // Récupération du nom de l'utilisateur
        $is_admin = $row_user['is_admin']; // Récupération de la valeur de is_admin
    } else {
        // Gestion des erreurs de requête
        echo "Erreur de requête : " . $mysqli->error;
        exit(); // Arrêter le script en cas d'erreur
    }

    // Requête SQL pour récupérer les catégories
    $sql_categories = "SELECT id, name FROM categories";
    $result_categories = $mysqli->query($sql_categories);

    // Vérifier si la requête a réussi
    if (!$result_categories) {
        // Gestion des erreurs de requête
        echo "Erreur de requête : " . $mysqli->error;
        exit(); // Arrêter le script en cas d'erreur
    }

    // Vérification si le formulaire a été soumis
    if(isset($_POST['submit'])) {
        // Récupération des données du formulaire
        $titre = $_POST['title'];
        $content = $_POST['content'];
        $category_id = $_POST['category']; // Récupération de l'ID de la catégorie sélectionnée

        // Traitement de l'image téléchargée
        $image_path = '';
        if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image_name = $_FILES['image']['name'];
            $image_tmp_name = $_FILES['image']['tmp_name'];
            $image_path = 'uploads/' . $image_name;
            move_uploaded_file($image_tmp_name, $image_path);
        }

        // Traitement de la vidéo téléchargée
        $video_path = '';
        if(isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
            $video_name = $_FILES['video']['name'];
            $video_tmp_name = $_FILES['video']['tmp_name'];
            $video_path = 'uploads/' . $video_name;
            move_uploaded_file($video_tmp_name, $video_path);
        }

        // Traitement de la music téléchargée
        $music_path = '';
        if(isset($_FILES['music']) && $_FILES['music']['error'] === UPLOAD_ERR_OK) {
            $music_name = $_FILES['music']['name'];
            $music_tmp_name = $_FILES['music']['tmp_name'];
            $music_path = 'uploads/' . $music_name;
            move_uploaded_file($music_tmp_name, $music_path);
        }


        // Requête SQL pour insérer la publication dans la base de données
        $sql_insert_post = "INSERT INTO posts (user_id, titre, content, image_path, video_path,music_path, category_id) VALUES ('$user_id', '$titre', '$content', '$image_path', '$video_path','$music_path' ,  '$category_id')";

        // Exécution de la requête
        if(!$mysqli->query($sql_insert_post)) {
        die("Erreur lors de l'exécution de la requête: " . $mysqli->error);
        }

        // Redirection vers la page d'affichage des publications
        header("refresh:1; url=/");
        exit();
    }
} else {
    // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: login.php");
    exit();
}
?>