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

    // Récupérer le nom de l'image téléchargée
    $image_name = $_FILES['profile_image']['name'];
    // Récupérer le chemin temporaire de l'image téléchargée sur le serveur
    $image_tmp_name = $_FILES['profile_image']['tmp_name'];

    // Définir le chemin de destination pour l'image téléchargée sur votre serveur
    $image_destination = '../Publication/uploads/' . $image_name;

    // Déplacer l'image téléchargée depuis le répertoire temporaire vers votre répertoire de destination
    move_uploaded_file($image_tmp_name, $image_destination);

    // Insérer les données dans la base de données
    $sql = "INSERT INTO users (firstname, lastname, username, email, password, profil_image) 
            VALUES ('$lastname', '$firstname', '$username', '$email', '$password', '$image_destination')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION["user_id"] = $conn->insert_id; // Récupérer l'ID de l'utilisateur inséré
        $_SESSION["login"] = "True";
        echo "Inscription réussie";
        // Rediriger vers une autre page après 2 secondes
        header("refresh:2; url=/");
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>