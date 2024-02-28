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
    $sql = "SELECT username, is_admin FROM users WHERE id = ?";
    $stmt = $mysqli->prepare($sql);

    // Vérifier si la préparation de la requête a échoué
    if(!$stmt) {
        die("Erreur de préparation de la requête: " . $mysqli->error);
    }

    $stmt->bind_param("i", $user_id);

    // Exécution de la requête
    if(!$stmt->execute()) {
        die("Erreur lors de l'exécution de la requête: " . $stmt->error);
    }

    $result = $stmt->get_result();

    // Vérification si la requête a réussi
    if ($result) {
        // Récupération des données de l'utilisateur
        $row = $result->fetch_assoc();
        $username = $row['username']; // Récupération du nom de l'utilisateur
        $is_admin = $row['is_admin']; // Récupération de la valeur de is_admin
    } else {
        // Gestion des erreurs de requête
        echo "Erreur de requête : " . $mysqli->error;
        exit(); // Arrêter le script en cas d'erreur
    }

    // Vérification si le formulaire a été soumis
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

        // Vérifier si la préparation de la requête a échoué
        if(!$stmt) {
            die("Erreur de préparation de la requête: " . $mysqli->error);
        }

        $stmt->bind_param("iss", $user_id, $content, $image_path);

        // Exécution de la requête
        if(!$stmt->execute()) {
            die("Erreur lors de l'exécution de la requête: " . $stmt->error);
        }

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