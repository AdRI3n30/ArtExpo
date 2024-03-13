<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="ART2.css" />
    <link rel="stylesheet" href="ART.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script  src="ArtExpo.js" defer></script>
  </head>
  <body >
    <div class="page-d-accueil">
      <div class="div">
        <div class="overlap">
          <div id="mySidenav" class="sidenav">
            <ul>
              <li><a href="/Catégorie/Vidéo/Vidéo.php">Vidéo</a></li>
              <li><a href="/Catégorie/Musique/Music.php">Musique</a></li>
              <li><a href="/Catégorie/Théâtre/Theatre.php">Théâtre</a></li>
              <li><a href="/Catégorie/Tableaux/Tableau.php">Tableaux</a></li>
              <li><a href="/Catégorie/Photos/Photo.php">Photos</a></li>
            </ul>
          </div>
          <div id="mySidenav2" class="sidenav2">
            <a id="closeBtn2" href="#" class="close2">×</a>
            <p>"La Création d'Adam" est une célèbre fresque qui fait partie du plafond de la Chapelle Sixtine au Vatican, réalisée par Michel-Ange entre 1508 et 1512.<br> L'image emblématique présente la scène biblique où Dieu donne la vie à Adam en lui tendant le doigt.<br> La composition expressive, la maîtrise technique et l'impact émotionnel de cette œuvre la rendent remarquable dans l'histoire de l'art de la Renaissance.<br><a class="lien_ref" href="https://www.wikiart.org/fr/michel-ange/la-creation-dadam-1510">Pour en savoir plus !</a></p>
          </div>
          <div class="overlap-group">
            <div class="text-wrapper">Michel-Ange</div>
            <div class="text-wrapper-2">La création d’Adam</div>
          </div>
          <div class="overlap-2">
            <div class="rectangle"></div>
              <a id="openBtn2" href="#" class="open2">
                <button class="Explorer" role="button">Explorer</button> 
              </a> 
            </div>
        </div>
        <header class="header">
          <div class="overlap-3">
            <img class="logo" src="img/logo.png" />
            <div class="text-wrapper-3"><button class="Accueil" role="button">Accueil</button></div>
            <a id="openBtn" href="#" class="open">
              <button class="Catégories" role="button">Catégories</button>
            </a>
            <div class="text-wrapper-5"><a href="/Catégorie/Contact/contact.php"><button class="Contact" role="button">Contact</button></a></div>
            <?php 
            if ($_SESSION["login"]=="false"){
              echo "<div class=\"text-wrapper-6\"><a href=\"/connexion/connexion.php\"><button class=\"Connexion\" role=\"button\">Connexion</button></a></div>";
            }else{
              echo "<a href=\"/Profil/Profil.php\"><img id=\"pppetit\" src=\"/img/pp.png\" alt=\"\"></a>";
            }
            ?>
          </div>
        </header>
      </div>
    </div>
  </body>
</html>