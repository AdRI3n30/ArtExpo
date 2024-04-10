<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/CSS/profile.css">
    <link rel="stylesheet" href="/CSS/main.css">
    <link rel="stylesheet" href="/CSS/header.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
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
        <div class="content" id="glassmorph">
            <h1>Pseudo</h1>
            <div class="information">
                <div class="ProfilPhoto">
                    <img id="ProfilPhoto" src="../../img/rick.png" alt="">
                </div>
                <?php
            // Vérifier si l'utilisateur est connecté
            session_start();
            if(isset($_SESSION["user_id"])) {
                // Récupérer l'ID de l'utilisateur depuis la session
                $user_id = $_SESSION["user_id"];

                // Connexion à la base de données
                $servername = "localhost";
                $username_mysql = "root"; // Nom d'utilisateur MySQL
                $password_mysql = ""; // Mot de passe MySQL
                $dbname = "artexpo";

                $conn = new mysqli($servername, $username_mysql, $password_mysql, $dbname);

                // Vérifier la connexion
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Préparer et exécuter la requête SQL pour récupérer les informations de l'utilisateur
                $stmt = $conn->prepare("SELECT firstname , lastname, username, email, profil_image FROM users WHERE id = ?");
                $stmt->bind_param("i", $user_id);

                // Exécuter la requête
                $stmt->execute();

                // Récupérer le résultat de la requête
                $result = $stmt->get_result();

                // Vérifier si des résultats ont été trouvés
                if ($result->num_rows > 0) {
                    // Récupérer les données de l'utilisateur
                    $row = $result->fetch_assoc();
                    $username = $row['username'];
                    $firstname = $row['firstname'];
                    $lasttname = $row['lastname'];
                    $email = $row['email'];
                    $profile_image = $row['profil_image'];
                    echo "<div class=\"info\">";
                    echo "<h2>Nom Utilisateur</h2>";
                    echo "<p>$username</p>";
                    echo "<h2>Prénom </h2>";
                    echo "<p>$firstname</p>";
                    echo "<h2>Nom </h2>";
                    echo "<p>$lasttname</p>";
                    echo "<h2>Mail</h2>";
                    echo "<p>$email</p>";
                    echo "</div>";
                } else {
                    // Aucune information trouvée pour cet ID d'utilisateur
                    echo "Aucune information disponible pour cet utilisateur.";
                }

                // Fermer la connexion à la base de données
                $stmt->close();
                $conn->close();
            } else {
                // L'utilisateur n'est pas connecté
                echo "Veuillez vous connecter pour afficher votre profil.";
            }
            ?>
                <a href="../Deconnexion.php"><button class="button-64" role="button"><span class="text">Deconnexion</span></button></a>
            </div>
            
        </div>
    </div>
</body>
</html>