<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <!-- importer le fichier de style -->
      <link rel="stylesheet" href="Connexion.css" media="screen" type="text/css" />
   </head>
   <body>
      <div class="overlap-3">
         <a href="/ART.php"><button class="butlogo"> <img class="logo" src="/img/LOGO PAPILLON.webp" /> </button></a>
      </div>
      <div id="container">
      <!-- zone de connexion -->
      
         <form action="login.php" method="post" >
            <h1>Connexion</h1>
            
            <label for="username"><b>Nom d'utilisateur</b></label>
            <input type="text" placeholder="Entrer le nom d'utilisateur" id="username" name="username" required>

            <label for="password"><b>Mot de passe</b></label>
            <input type="password" placeholder="Entrer le mot de passe" id="password" name="password" required>

            <input type="submit" id='submit' value='Login' >

            <label><a href="/Inscription/inscription.php" class="compte"><b>Je n'ai pas de compte ?</b></a></label>

         </form>
      </div>
   </body>  
</html>