<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "monsite_users";

$conn = new mysqli($servername,$username, $password, $dbname);


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
    // Le reste de votre code pour le traitement de l'inscription
    // Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    
}

// Récupérer les données du formulaire
$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hasher le mot de passe

// Insérer les données dans la base de données
$sql = "INSERT INTO users (firstname , lastname,username, email, password) VALUES ('$lastname','$firstname','$username', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful";
    // Rediriger vers une autre page après 2 secondes
    echo '<meta http-equiv="refresh" content="2;url=ART.html">';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Fermer la connexion à la base de données
$conn->close();

}

?>