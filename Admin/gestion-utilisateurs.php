<?php
session_start();

// Vérification des droits d'administration
if ($_SESSION["is_admin"] != 1 || $_SESSION["login"] == "false") {
    // Redirection vers une autre page ou affichage d'un message d'erreur
    header("Location: /");
    exit;
}

// Traitement pour récupérer la liste des utilisateurs depuis la base de données
$users = []; // Initialisation du tableau des utilisateurs

// Remplacez les valeurs de connexion à la base de données par les vôtres
$servername = "localhost";
$username_mysql = "root"; // Nom d'utilisateur MySQL
$password_mysql = ""; // Mot de passe MySQL
$dbname = "artexpo";

// Connexion à la base de données
$conn = new mysqli($servername, $username_mysql, $password_mysql, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Requête SQL pour récupérer la liste des utilisateurs
$sql = "SELECT id, username, email FROM users";
$result = $conn->query($sql);

// Vérifier s'il y a des résultats
if ($result->num_rows > 0) {
    // Parcourir les résultats et les stocker dans le tableau des utilisateurs
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
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
    <title>Gestion des utilisateurs - Admin</title>
    <link rel="stylesheet" href="/CSS/main.css">
    <link rel="stylesheet" href="/CSS/header.css">
    <link rel="icon" type="image/x-icon" href="../../img/Logonobg.png">
</head>
<body>
    <header>
        <div class="HeaderHaut">
            <div class="logo" id="logo"><a href="/"><img src="../../img/Logonobg.png" alt=""></a></div>
            <div class="navbar">
                <a href="">Accueil</a>
                <a href="/Catégorie/Contact/Contact.php">Contact</a>
                <a href="/Publication/index.php">Post</a>
                <a href="/Admin/admin-lobby.php">Admin</a>
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
        <h2>Gestion des utilisateurs</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td>
                            <!-- Bouton de suppression -->
                            <form method="post" action="supprimer-utilisateur.php">
                                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                <button type="submit">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
