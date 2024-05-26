<?php
session_start();

// Vérification des droits d'administration
if ($_SESSION["is_admin"] != 1) {
    // Redirection vers une autre page ou affichage d'un message d'erreur
    header("Location: /");
    exit;
}

// Traitement pour récupérer la liste des posts depuis la base de données
$posts = []; // Initialisation du tableau des posts

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

// Requête SQL pour récupérer la liste des posts
$sql = "SELECT id, titre, content, user_id FROM posts";
$result = $conn->query($sql);

// Vérifier s'il y a des résultats
if ($result->num_rows > 0) {
    // Parcourir les résultats et les stocker dans le tableau des posts
    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
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
    <title>Gestion des publications - Admin</title>
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
        <h2>Gestion des publications</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Contenu</th>
                    <th>Auteur</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post) : ?>
                    <tr>
                        <td><?php echo $post['id']; ?></td>
                        <td><?php echo $post['titre']; ?></td>
                        <td><?php echo $post['content']; ?></td>
                        <td><?php echo $post['user_id']; ?></td>
                        <td>
                            <!-- Bouton de suppression -->
                            <form method="post" action="supprimer-post.php">
                                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
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
