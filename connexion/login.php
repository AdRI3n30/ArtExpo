<?php
// Connexion à la base de données
$servername = "localhost";
$username_mysql = "root"; // Nom d'utilisateur MySQL
$password_mysql = ""; // Mot de passe MySQL
$dbname = "monsite_users";
$login = false;

// Vérifier si les données ont été soumises via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer le nom d'utilisateur et le mot de passe soumis
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Créer une connexion avec le bon nom d'utilisateur et mot de passe
    $conn = new mysqli($servername, $username_mysql, $password_mysql, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Préparer et exécuter la requête SQL en utilisant une requête préparée
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);

    // Vérifier les informations dans la base de données
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Rediriger vers la racine du site
            $login = true;
            header("Location: /ART2/ART2.php");
            exit();
        } else {
            echo "Invalid password";
        }
    } else {
        echo "User not found";
    }

    // Fermer la connexion à la base de données
    $stmt->close();
    $conn->close();
}
?>