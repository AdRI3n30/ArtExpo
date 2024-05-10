<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "artexpo";
session_start();

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Supposons que vous ayez récupéré l'email à partir du formulaire
$email = $_POST['email'];

// Vérifier si l'email se termine par "@ynov.com"
$domainToCheck = "@ynov.com";
$emailLength = strlen($email);
$domainLength = strlen($domainToCheck);

// Utilisation de substr_compare pour comparer la fin de la chaîne
if (substr_compare($email, $domainToCheck, $emailLength - $domainLength, $domainLength) !== 0) {
    echo "Erreur : L'adresse email doit se terminer par @ynov.com";
} else {
    // Récupérer les données du formulaire
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hasher le mot de passe

    $image_path = "";
    if(isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $image_name = $_FILES['profile_image']['name'];
        $image_tmp_name = $_FILES['profile_image']['tmp_name'];
        $image_path = "imgProfil/" .$image_name;
        move_uploaded_file($image_tmp_name, $image_path);
    }else{
        echo "NON" . "<br>";
    }     

        // Préparation de la requête avec une déclaration préparée
    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, username, email, password, profil_image) 
    VALUES (?, ?, ?, ?, ?, ?)");

    // Liaison des valeurs aux paramètres de la déclaration préparée
    $stmt->bind_param("ssssss", $lastname, $firstname, $username, $email, $password, $image_path);

    // Exécution de la requête
    if ($stmt->execute()) {
    $_SESSION["user_id"] = $conn->insert_id; // Récupérer l'ID de l'utilisateur inséré
    $_SESSION["login"] = "True";
    // Rediriger vers une autre page après 2 secondes
    header("refresh:1; url=/");
    } else {
    echo "Erreur: " . $stmt->error;
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>