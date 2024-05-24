<?php
session_start();
// Vérifier si l'utilisateur est connecté
if ($_SESSION["login"] == "false" || $_SESSION["is_admin"] != 1) {
    header("Location: /"); // Rediriger vers la page principale
    exit; // Arrêter l'exécution du script après la redirection
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - ArtExpo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/CSS/header.css" />
    <link rel="stylesheet" href="/CSS/index.css">
    <link rel="stylesheet" href="/CSS/main.css">
    <link rel="icon" type="image/x-icon" href="../../img/Logonobg.png">
    <script src="/JS/contact.js"></script>
</head>
<body>
<header>
    <div class="HeaderHaut">
        <div class="logo" id="logo"><a href="/"><img src="../../img/Logonobg.png" alt=""></a></div>
        <div class="navbar">
            <a href="">Accueil</a>
            <a href="/Catégorie/Contact/Contact.php">Contact</a>
            <a href="/Publication/index.php">Post</a>
            <?php
            // Vérifier si l'utilisateur est un administrateur
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
<?php
    // Afficher les boutons d'administration si l'utilisateur est un administrateur
    if ($_SESSION["is_admin"] == 1) {
        echo '<div class="admin-buttons">';
        echo '<a href="/Admin/gestion-utilisateurs.php" class="admin-button">Gérer les utilisateurs</a>';
        echo '<a href="/Admin/gestion-posts.php" class="admin-button">Gérer les posts</a>';
        echo '<a href="/Admin/gestion-commentaires.php" class="admin-button">Gérer les commentaires</a>';
        echo '</div>';
    }
    ?>
</body>
</html>        