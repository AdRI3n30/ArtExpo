<?php
session_start();
// Vérifier si l'utilisateur est connecté et est administrateur
if ($_SESSION["login"] == "false" || $_SESSION["is_admin"] != 1) {
    header("Location: /"); // Rediriger vers la page principale si non connecté ou non admin
    exit; // Arrêter l'exécution du script après la redirection
}

// Connexion à la base de données
$servername = "localhost";
$username_mysql = "root"; // Nom d'utilisateur MySQL
$password_mysql = ""; // Mot de passe MySQL
$dbname = "artexpo";

// Connexion à la base de données
$conn = new mysqli($servername, $username_mysql, $password_mysql, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les commentaires depuis la base de données
$sql = "SELECT id, user_id, post_id, message, created_at FROM comments";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Commentaires - ArtExpo</title>
    <link rel="stylesheet" href="/CSS/header.css" />
    <link rel="stylesheet" href="/CSS/main.css">
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
            <?php
            // Vérifier si l'utilisateur est un administrateur
            if ($_SESSION["is_admin"] == 1) {
                echo '<a href="/Admin/admin-lobby.php">Admin</a>';
            }
            ?>
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
        <h1>Gestion des Commentaires</h1>
        <?php if ($result->num_rows > 0): ?>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Post ID</th>
                    <th>Content</th>
                    <th>Actions</th>
                </tr>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["post_id"]; ?></td>
                    <td><?php echo $row["message"]; ?></td>
                    <?php
                         echo '<td><a href="supprimer-commentaire.php?id=' . htmlspecialchars($row['id']) . '">Supprimer</a></td>';
                    ?>
                </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p class="message">No comments found.</p>
        <?php endif; ?>
        <a href="/Admin/admin-lobby.php" class="retour">Retour au profil</a>
    </div>

    <script>
        function deleteComment(commentId) {
        // Demander confirmation avant de supprimer le commentaire
        if (confirm("Êtes-vous sûr de vouloir supprimer ce commentaire?")) {
            // Envoyer une requête AJAX pour supprimer le commentaire
            fetch('/delete_comment.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ commentId: commentId }),
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erreur lors de la suppression du commentaire');
                }
                // Recharger la page après la suppression
                window.location.reload();
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Erreur lors de la suppression du commentaire');
            });
        }
    }
    </script>
</body>
</html>

<?php
// Fermer la connexion à la base de données
$conn->close();
?>
