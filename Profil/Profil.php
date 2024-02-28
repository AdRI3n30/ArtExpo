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
                <li><div id="navee"><a href="/">Accueil</a></div></li>
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
                $stmt = $conn->prepare("SELECT firstname , lastname, username, email FROM users WHERE id = ?");
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

                    // Afficher les informations de l'utilisateur
                    echo "<p>Nom Utilisateur</p>";
                    echo "<h2>$username</h2>";
                    echo "<p>Prénom </p>";
                    echo "<h2>$firstname</h2>";
                    echo "<p>Nom </p>";
                    echo "<h2>$lasttname</h2>";
                    echo "<p>Mail</p>";
                    echo "<h2>$email</h2>";
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
        </div>
    </section>

    <div class="deco"><a href="../Deconnexion.php" class="btn-deco">Deconexion</button></a></div>
    
</body>
</html>