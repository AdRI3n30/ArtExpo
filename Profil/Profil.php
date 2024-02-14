<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Profil.css">
    <script  src="Profil.js" defer></script>
    <title>Profil</title>
</head>
<body>
    <div class="headers">
        <div class="headerleft">
            <img src="../img/logo.png " id="logo" alt="">
        </div>
        <div id="mySidenav" class="sidenav">
            <ul>
            <li><a href="/Catégorie/Vidéo/Videopage.php">Vidéo</a></li>
            <li><a href="/Catégorie/Musique/Music.php">Musique</a></li>
            <li><a href="/Catégorie/Théâtre/Theatre.php">Théâtre</a></li>
            <li><a href="/Catégorie/Tableaux/Tableau.php">Tableaux</a></li>
            <li><a href="/Catégorie/Photos/Photo.php">Photos</a></li>
            </ul>
        </div>
        <div class="headerright"> 
            <ul class="navbar">
                <li><div id="navee"><a href="../ART2/ART2.php">Accueil</a></div></li>
                <li>
                    <a id="openBtn" href="#" class="open">
                    <button class="Catégories" role="button">Catégories</button>
                  </a>
                </li>
                <li><div id="navee"><a href="../Catégorie/Contact/Contact.php">Contact</a></div></li>
            </ul>
                <a href="./Profil.php"><img id="pppetit" src="../img/pp.png" alt=""></a>
        </div>
    </div>
    <section id="container">
        <div class="leftside">
            <div class="test"><img id="logog" src="../img/pp.png" alt=""></div>
            <h1>Profil</h1>
        </div>
        <div class="rightside">
            <p>Nom Utilisateur</p>
            <h2>Pierre</h2>
            <p>Nom </p>
            <h2>Pierre Ducop</h2>
            <p>Mail</p>
            <h2>Pierre.Ducop@ynov.com</h2>
            <p>Bio</p>
            <textarea cols="70" rows="10">Zone de texte!</textarea>
        </div>
    </section>
    <div id="deco"><button id="btn-deco">Deconexion</button></div>
    
</body>
</html>