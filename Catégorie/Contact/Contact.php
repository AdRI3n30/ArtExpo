<?php
  session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtExpo - Contact</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../CSS/header.css" />
    <link rel="stylesheet" href="../../CSS/index.css">
    <link rel="stylesheet" href="../../CSS/main.css">
    <link rel="stylesheet" href="../../CSS/contact.css">
    <link rel="icon" type="image/x-icon" href="../../img/Logonobg.png">
</head>
<body>
    <header>
        <div class="HeaderHaut">
            <div class="logo" id="logo"><a href="/"><img src="../../img/Logonobg.png" alt=""></a></div>
        <div class="navbar">
            <a href="/">Accueil</a>
                    <a href="/Catégorie/Contact/Contact.php">Contact</a>
                    <?php
                    if ($_SESSION["login"] == "false") {
                        echo '<a href="/connexion/connexion.php">Connexion</a>';
                    } else{
                        if ($_SESSION["is_admin"] == 1) {
                            echo'<a href="/Publication/index.php">Post</a>';
                            echo '<a href="/Admin/admin-lobby.php">Admin</a>';
                            echo '<a href="/Profil/Profil.php">Profil</a>';
                        } else {
                            echo'<a href="/Publication/index.php">Post</a>';
                             echo '<a href="/Profil/Profil.php">Profil</a>';
                            } 
                    }
                ?>
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
    <section>
        <div class="container">
            <h1> Contactez-Nous</h1>
            <p class="description">Nous sommes disponible si vous avez besoins de nous contactez</p>
        </div>
        <div class="container2">
            <img src="../../img/Enveloppe.png" alt="" id="env"><br>
        </div>

        <div class="slider-wrapper">
            <div class="slider">
                <div class="slide-1">
                    <p class="mail" id="slide-1">oceane.miessan@ynov.com <br> Chef du projet ArtExpo
                    </p>
                </div>
                <div class="slide-2">
                    <p class="mail" id="slide-2">divine.miessan@ynov.com<br> Chef du projet ArtExpo</p>
                </div> 
            </div>
        </div>
    </section>
    <script src="../../JS/contact.js"></script>
</body> 