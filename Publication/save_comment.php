<?php
// Inclusion du fichier de connexion à la base de données
require_once 'database.php';

// Démarrage de la session
session_start();

// Vérification si l'utilisateur est connecté
if(isset($_SESSION['user_id'])) {
    // Vérifier si les données du formulaire ont été soumises
    if(isset($_POST['post_id'], $_POST['message'])) {
        // Récupérer les données du formulaire
        $post_id = $_POST['post_id'];
        $user_id = $_SESSION['user_id'];
        $message = $_POST['message'];

        // Requête SQL pour insérer le commentaire dans la base de données
        $sql = "INSERT INTO comments (post_id, user_id, message) VALUES (?, ?, ?)";
        $stmt = $mysqli->prepare($sql);

        // Vérifier si la préparation de la requête a réussi
        if($stmt) {
            // Liaison des valeurs et exécution de la requête
            $stmt->bind_param("iis", $post_id, $user_id, $message);
            $stmt->execute();

            // Redirection vers la page précédente après l'enregistrement du commentaire
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit();
        } else {
            // Gestion des erreurs de requête
            echo "Erreur de préparation de la requête : " . $mysqli->error;
        }
    } else {
        // Les données du formulaire ne sont pas complètes
        echo "Tous les champs du formulaire sont requis.";
    }
} else {
    // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: login.php");
    exit();
}
?>
