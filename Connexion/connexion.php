<html>
 <head>
 <meta charset="utf-8">
 <!-- importer le fichier de style -->
 <link rel="stylesheet" href="Connexion.css" media="screen" type="text/css" />
 </head>
 <body>
 <div class="overlap-3">
    <a href="/ART.html"><button class="butlogo"> <img class="logo" src="/img/LOGO PAPILLON.webp" /> </button></a>
 </div>
 <div id="container">
 <!-- zone de connexion -->
 
 <form action="verification.php" method="POST">
 <h1>Connexion</h1>
 
 <label><b>Nom d'utilisateur</b></label>
 <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

 <label><b>Mot de passe</b></label>
 <input type="password" placeholder="Entrer le mot de passe" name="password" required>

 <input type="submit" id='submit' value='LOGIN' >
 <?php
 if(isset($_GET['erreur'])){
 $err = $_GET['erreur'];
 if($err==1 || $err==2)
 echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
 }
 ?>
 <label><a href="/Inscription/inscription.html" class="compte"><b>Je n'ai pas de compte ?</b></a></label>

 </form>
 </div>
 </body>
</html>