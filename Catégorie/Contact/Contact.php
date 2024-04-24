<?php
  session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../CSS/header.css" />
    <link rel="stylesheet" href="../../CSS/index.css">
    <link rel="stylesheet" href="../../CSS/main.css">
    <link rel="stylesheet" href="../../CSS/contact.css">
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
                    } else {
                        echo '<a href="/Profil/Profil.php">Profil</a>';
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
                    <p class="mail" id="slide-1">Oceane.miessam@ynov.com <br> Chef du projet ArtExpo
                    </p>
                </div>
                <div class="slide-2">
                    <p class="mail" id="slide-2">Ludivine.miessam@ynov.com<br> Chef du projet ArtExpo</p>
                </div> 
                <div class="slide-3">
                    <p class="mail" id="slide-3">Yanis.saoudi@ynov.com <br>Designer du projet ArtExpo</p>
                </div> 
                <div class="slide-4">
                    <p class="mail" id="slide-4">Along.licakis@ynov.com <br>Developper du projet ArtExpo</p>
                </div>  
                <div class="slide-5">
                    <p class="mail" id="slide-5">Tom.Balluri@ynov.com <br>Developper du projet ArtExpo</p>
                </div>
                <div class="slide-6">
                    <p class="mail" id="slide-6">Adrien.boree@ynov.com<br>Developper du projet ArtExpo</p>
                </div> 
            </div>
            <div class="slider-nav">
                <a href="#slide-1"></a>
                <a href="#slide-2"></a>
                <a href="#slide-3"></a>
                <a href="#slide-4"></a>
                <a href="#slide-5"></a>
                <a href="#slide-6"></a>
                
            </div>
        </div>
    </section>
    <script src="../../JS/contact.js"></script>
</body> 