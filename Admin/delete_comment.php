<?php
// Vérifier si la requête est de type POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si l'ID du commentaire est présent dans la requête
    if (isset($_POST["commentId"])) {
        // Récupérer l'ID du commentaire à supprimer depuis la requête
        $commentId = $_POST["commentId"];
        
        // Connexion à la base de données
        $servername = "localhost";
        $username = "votre_nom_utilisateur";
        $password = "votre_mot_de_passe";
        $dbname = "votre_base_de_données";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Vérifier la connexion à la base de données
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        // Préparer et exécuter la requête SQL pour supprimer le commentaire
        $stmt = $conn->prepare("DELETE FROM comments WHERE id = ?");
        $stmt->bind_param("i", $commentId);
        
        // Exécuter la requête
        if ($stmt->execute()) {
            // Succès de la suppression du commentaire
            echo json_encode(array("success" => true));
        } else {
            // Échec de la suppression du commentaire
            echo json_encode(array("success" => false, "message" => "Erreur lors de la suppression du commentaire"));
        }
        
        // Fermer la connexion à la base de données
        $stmt->close();
        $conn->close();
    } else {
        // L'ID du commentaire n'est pas présent dans la requête
        echo json_encode(array("success" => false, "message" => "ID du commentaire manquant dans la requête"));
    }
} else {
    // Requête non autorisée (devrait être POST)
    echo json_encode(array("success" => false, "message" => "Requête non autorisée"));
}
?>
