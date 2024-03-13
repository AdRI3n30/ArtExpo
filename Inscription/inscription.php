<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="inscription.css" media="screen" type="text/css" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script  src="inscription.js" defer></script>
        <title>Formulaire php</title>
    </head>
    <body>
        <div class="overlap-3">
            <a href="/ART.php"><button class="butlogo"> <img class="logo" src="/img/LOGO PAPILLON.webp" /> </button></a>
         </div>
        <div id="container">
            <div id="snackbar-container"></div>
            <form action="register.php" method="post" enctype="multipart/form-data">
                <label for="lastname">Votre nom :</label>
                <input type="text"placeholder="Votre nom" id="lastname" name="lastname" required>

                <label for="firstname">Votre Prénom :</label>
                <input type="text" placeholder="Votre Prénom"  id="firstname" name="firstname"required>

                <label for="username">Votre Pseudo :</label>
                <input type="text"placeholder="Votre Pseudo" id="username" name="username" required>

                <label for="email">Votre adresse mail Ynov :</label>
                <input type="email" placeholder="Votre adresse mail Ynov" id="email" name="email" required>

                <label for="password"> Votre mot de passe :</label>
                <input type="password" placeholder="Mot de passe" id="password" name="password" required>

                <label for="profile_image"> Votre image de profil :</label>
                <input type="file" name="profile_image"  >

                <input type=submit value="Register">
                <label><a href="/Connexion/connexion.php" class="compte"><b>J'ai retrouvé mon compte</b></a></label>
            </form>
        </div> 
    </body>
</html>