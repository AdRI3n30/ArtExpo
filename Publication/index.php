<?php
session_start();

// Vérifier si l'utilisateur est connecté
if ($_SESSION["login"] == "false") {
    header("Location: /"); // Rediriger vers la page principale
    exit; // Arrêter l'exécution du script après la redirection
}

// Le reste de votre code ici...
?>
<!DOCTYPE html>
<html>
<head>
    <title>ArtExpo - CréationPost</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/CSS/main.css">
    <link rel="stylesheet" href="/CSS/header.css">
    <link rel="stylesheet" href="/CSS/publication.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" type="image/x-icon" href="../../img/Logonobg.png">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Kanit&family=Lato:ital,wght@1,100&family=Madimi+One&family=Playfair+Display:ital,wght@1,800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="HeaderHaut">
            <div class="logo" id="logo"><a href="/"><img src="../../img/Logonobg.png" alt=""></a></div>
        <div class="navbar">
            <a href="/">Accueil</a>
            <a href="/Catégorie/Contact/Contact.php">Contact</a>
            <a href="/Publication/index.php">Post</a>
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
    <div class="fond"></div>
    <div class="container">
        <h2>Montre nous ton talent</h2>
        <form action="process_post.php" method="post" enctype="multipart/form-data">
            <label for="Titre">Titre :</label>
            <input type="text" name="title" placeholder="Titre de la publication" required><br>
            <label for="Description">Description :</label>
            <textarea name="content" placeholder="Saisissez votre publication ici" required></textarea>
            <label for="image">Image :</label>
            <input type="file" name="image">
            <label for="video">Vidéo :</label>
            <input type="file" name="video"><br>
            <label for="category">Catégorie :</label>
            <select name="category" id="category">
                <?php
                // Inclure le fichier de connexion à la base de données
                require_once 'database.php';

                // Requête SQL pour récupérer toutes les catégories
                $sql = "SELECT * FROM categories";
                $result = $mysqli->query($sql);

                // Parcourir les résultats et afficher les options de la liste déroulante
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
                ?>
            </select><br>
            <input type="submit" name="submit" value="Publier"><br>
        </form>
    </div>    
</body>
</html>