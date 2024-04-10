<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <link href="https://fonts.googleapis.com/css2?family=Mulish&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/CSS/inscription.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulaire php</title>
    </head>
    <body>
        <div class="background"></div>
        <div class="centering">
            <form action="register.php" method="post" class="my-form">
                <div class="login-welcome-row">
                    <img
                        class="login-welcome"
                        src="../../img/Logonobg.png"
                        alt="Astronaut"
                    >
                    <h1>Register !</h1>
                </div>
                <div class="text-field"> 
                    <label for="lastname">Votre nom :</label>
                    <input type="text"placeholder="Votre nom" id="lastname" name="lastname" required>
                </div>
                <div class="text-field"> 
                    <label for="firstname">Votre Prénom :</label>
                    <input type="text" placeholder="Votre Prénom"  id="firstname" name="firstname"required>
                </div>

                <div class="text-field"> 
                    <label for="username">Votre Pseudo :</label>
                    <input type="text"placeholder="Votre Pseudo" id="username" name="username" required>
                </div>

                <div class="text-field"> 
                    <label for="email">Votre adresse mail Ynov :</label>
                    <input type="email" placeholder="Votre adresse mail Ynov" id="email" name="email" required>
                </div>
                
                <div class="text-field"> 
                    <label for="password"> Votre mot de passe :</label>
                    <input type="password" placeholder="Mot de passe" id="password" name="password" required>
                </div>

                <label class="img-label" for="profile_image"> Votre image de profil :</label>
                <div class="text-field2">
                    <input type="file" name="profile_image" id="profile_image" class="custom-file-upload" value="Choisir un fichier">
                </div>
                <input type=submit value="Register" class="my-form__button">
                <div class="my-form__actions">
                    <div class="my-form__signup">
                        <a href="/Connexion/connexion.php" title="Create Account" class="page-transition">Se connecter</a>
                        <script src="script.js"></script>
                    </div>
                </div>
            </form>
        </div> 
    </body>
</html>