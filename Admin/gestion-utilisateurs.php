<?php
session_start();
// Vérifier si l'utilisateur est connecté
if ($_SESSION["login"] == "false") {
    header("Location: /"); // Rediriger vers la page principale
    exit; // Arrêter l'exécution du script après la redirection
}

// Fonction pour rechercher un utilisateur par son ID
function searchUserById($conn, $userId) {
    $sql = "SELECT id, firstname, lastname, username, email, is_admin FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}

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

// Initialiser la variable pour stocker les informations de l'utilisateur trouvé
$foundUser = null;

// Vérifier si une recherche par ID a été soumise
if (isset($_GET['search_id'])) {
    $searchId = $_GET['search_id'];
    // Rechercher l'utilisateur par ID
    $foundUser = searchUserById($conn, $searchId);
}

// Requête SQL pour récupérer tous les utilisateurs
$sql = "SELECT id, firstname, lastname, username, email, is_admin FROM users";
$result = $conn->query($sql);

// Récupère les utilisateurs
$users = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des utilisateurs - Admin</title>
    <link rel="stylesheet" href="/CSS/main.css">
    <link rel="stylesheet" href="/CSS/header.css">
    <link rel="stylesheet" href="/CSS/admin.css">
    <link rel="icon" type="image/x-icon" href="../../img/Logonobg.png">
</head>
<body>
    <header>
        <div class="HeaderHaut">
            <div class="logo" id="logo"><a href="/"><img src="../../img/Logonobg.png" alt=""></a></div>
            <div class="navbar">
                <a href="">Accueil</a>
                <a href="/Catégorie/Contact/Contact.php">Contact</a>
                <a href="/Publication/index.php">Post</a>
                <a href="/Admin/admin-lobby.php">Admin</a>
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

    <div class="container">
        <h2>Gestion des utilisateurs</h2><br>
        <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="search_id">Rechercher par ID :</label>
            <input type="text" id="search_id" name="search_id" placeholder="Entrez l'ID de l'utilisateur">
            <button type="submit">Rechercher</button><br>
        </form>
          <!-- Affichage des résultats de la recherche -->
          <?php if ($foundUser) : ?>
            <h2>Résultat de la recherche :</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Pseudo</th>
                        <th>Email</th>
                        <th>Admin</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $foundUser['id']; ?></td>
                        <td><?php echo $foundUser['firstname']; ?></td>
                        <td><?php echo $foundUser['lastname']; ?></td>
                        <td><?php echo $foundUser['username']; ?></td>
                        <td><?php echo $foundUser['email']; ?></td>
                        <td><?php echo $foundUser['is_admin']; ?></td>
                        <!-- Bouton Supprimer -->
                        <td><?php echo '<a href="supprimer-utilisateur.php?id=' . $foundUser["id"] . '">Supprimer</a>'; ?></td>
                    </tr>
                </tbody>
            </table>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Admin</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['firstname']; ?></td>
                            <td><?php echo $user['lastname']; ?></td>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['is_admin'];?></td>
                            <?php
                            echo '<td><a href="supprimer-utilisateur.php?id=' . htmlspecialchars($user['id']) . '">Supprimer</a></td>';
                            ?>
                            
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a href="/Admin/admin-lobby.php" class="retour">Retour au profil</a>
        <?php endif; ?>    
     </div>   
</body>
</html>
