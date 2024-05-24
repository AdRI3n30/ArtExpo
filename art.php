<?php
  session_start();
  if (!isset($_SESSION["login"])) {
    $_SESSION["login"] = "false";
    $_SESSION["is_admin"] = 0; // Initialisation de la variable de session à false
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
                <?php
                if ($_SESSION["login"] == "false") {
                    echo '<a href="/connexion/connexion.php">Connexion</a>';
                } else {
                    if ($_SESSION["is_admin"] == 1) {
                        echo '<a href="/Publication/index.php">Post</a>';
                        echo '<a href="/Admin/admin-lobby.php">Admin</a>';
                        echo '<a href="/Profil/Profil.php">Profil</a>';
                    } else {
                        echo '<a href="/Publication/index.php">Post</a>';
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
        <div class="container">
            <div class="firstband">
                <div id="glassmorph" class="text">
                    
                    <h1>ArtExpo</h1>
                    <p>
                        Venez Partager Vos Créations
                    </p>
                    
                </div>
            </div>
            <div class="secondband">
                <div id="glassmorph" class="text2">
                    <div><h1>La Création d'Adam (Michel-Ange)</h1></div>
                    <div class="content"> 
                        <div class="logo2" id="logo"><img src="../../img/adam.jpg" alt=""></div>
                    
                    <p>
                    Peintes par Michel-Ange sur la partie centrale de la voûte du plafond de la chapelle Sixtine, dans les musées du Vatican à Rome, commandée par le pape Jules II.
                    </p>
                </div>
                
                    
                </div>
                <div id="glassmorph" class="text2">
                    <div>
                        <h1>Lucas S</h1>
                    </div>
                    <div class="content">
                        <div class="logo2" id="logo"><a href="../../Profil/Profil.php"><img src="../../img/pp.png" alt=""></a></div>
                    <p>
                        cc c lucas celib et cherche amour svp 
                    </p>
                    </div>
                </div>        
            </div>
        </div>
    </div>
</body>
</html>