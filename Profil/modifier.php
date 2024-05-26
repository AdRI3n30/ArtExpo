<?php
session_start();
// Vérifier si l'utilisateur est connecté
if ($_SESSION["login"] == "false") {
    header("Location: /"); // Rediriger vers la page principale
    exit; // Arrêter l'exécution du script après la redirection
}

// Vérifier si un champ de modification est spécifié dans l'URL
if (isset($_GET['field'])) {
    $field = $_GET['field'];
} else {
    // Rediriger vers la page de profil si aucun champ n'est spécifié
    header("Location: Profil.php");
    exit;
}

// Fonction de récupération des données utilisateur
function getUserData($conn, $user_id) {
    $stmt = $conn->prepare("SELECT firstname, lastname, username, email FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    return false;
}

// Connexion à la base de données
$servername = "localhost";
$username_mysql = "root"; // Nom d'utilisateur MySQL
$password_mysql = ""; // Mot de passe MySQL
$dbname = "artexpo";

$conn = new mysqli($servername, $username_mysql, $password_mysql, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer l'ID de l'utilisateur depuis la session
$user_id = $_SESSION["user_id"];

// Récupérer les données utilisateur actuelles
$userData = getUserData($conn, $user_id);

// Vérifier si les données utilisateur sont récupérées avec succès
if (!$userData) {
    // Rediriger vers la page de profil si aucune donnée utilisateur n'est trouvée
    header("Location: Profil.php");
    exit;
}

// Vérifier quel champ de modification est spécifié
switch ($field) {
    case 'firstname':
        $currentValue = $userData['firstname'];
        $fieldName = "Prénom";
        break;
    case 'lastname':
        $currentValue = $userData['lastname'];
        $fieldName = "Nom";
        break;
    case 'username':
        $currentValue = $userData['username'];
        $fieldName = "Pseudo";
        break;
    case 'email':
        $currentValue = $userData['email'];
        $fieldName = "Email";
        break;
    default:
        // Rediriger vers la page de profil si un champ non valide est spécifié
        header("Location: Profil.php");
        exit;
}

// Traiter le formulaire de modification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer la nouvelle valeur du champ
    $newValue = $_POST['new_value'];

    // Préparer et exécuter la requête SQL pour mettre à jour le champ spécifié
    $stmt = $conn->prepare("UPDATE users SET $field = ? WHERE id = ?");
    $stmt->bind_param("si", $newValue, $user_id);
    if ($stmt->execute()) {
        // Rediriger vers la page de profil après la modification réussie
        header("Location: Profil.php");
        exit;
    } else {
        $error = "Erreur lors de la mise à jour des informations.";
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtExpo - Modifier <?php echo $fieldName; ?></title>
    <link rel="stylesheet" href="/CSS/main.css">
    <link rel="stylesheet" href="/CSS/header.css">
    <link rel="stylesheet" href="/CSS/modifier.css">
    <link rel="icon" type="image/x-icon" href="../../img/Logonobg.png">
</head>
<body>
    <header>
        <div class="HeaderHaut">
            <div class="logo" id="logo"><a href="/"><img src="../../img/Logonobg.png" alt=""></a></div>
            <div class="navbar">
                <a href="/">Accueil</a>
                <a href="/Catégorie/Contact/Contact.php">Contact</a>
                <a href="/Publication/index.php">Post</a>
                <?php
                if ($_SESSION["is_admin"] == 1) {
                    echo '<a href="/Admin/admin-lobby.php">Admin</a>';
                } 
            ?>
                <a href="/Profil/Profil.php">Profil</a>
            </div>
        </div>
        <div class="HeaderBas">
            <a href="/Catégorie/Musique/Music.php">Musique</a>
            <a href="/Catégorie/Théâtre/Théâtre.php">Théatre</a>
            <a href="/Catégorie/Vidéo/Vidéo.php">Vidéo</a>
            <a href="/Catégorie/Photos/Photo.php">Photo</a>
            <a href="/Catégorie/Tableaux/Tableau.php">Tableau</a>
        </div>
    </header>
    <div class="container">
        <div class="content">
            <h2>Modifier <?php echo $fieldName; ?></h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?field=$field"); ?>">
                <label for="new_value"><?php echo $fieldName; ?>:</label><br>
                <input type="text" id="new_value" name="new_value" value="<?php echo $currentValue; ?>"><br><br>
                <input type="submit" value="Enregistrer les modifications">
                <?php if(isset($error)) { echo "<p class='error'>$error</p>"; } ?>
            </form>
        </div>
    </div>
</body>
</html>
