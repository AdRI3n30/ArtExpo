<?php
// Inclusion du fichier de connexion à la base de données
require_once 'database.php';

// Démarrage de la session
session_start();

// Vérification si l'utilisateur est connecté
if(isset($_SESSION['user_id'])) {
    // Requête SQL pour récupérer les publications avec le pseudo de l'utilisateur qui les a créées
    $sql = "SELECT posts.*, users.username 
            FROM posts 
            JOIN users ON posts.user_id = users.id 
            ORDER BY posts.created_at DESC";
    $result = $mysqli->query($sql);

    // Vérifier si la requête a réussi
    if ($result) {
        // Initialisation d'un tableau pour stocker les publications
        $posts = [];

        // Parcours des résultats et stockage des publications dans le tableau
        while ($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }

        // Libération de la mémoire utilisée par le résultat
        $result->free();
    } else {
        // Gestion des erreurs de requête
        echo "Erreur de requête : " . $mysqli->error;
    }

    // Vérification si $_SESSION['is_admin'] est défini
    $is_admin = isset($_SESSION['is_admin']) ? $_SESSION['is_admin'] : false;
} else {
    // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Affichage des Publications</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h2>Publications</h2>
    <ul>
        <?php foreach($posts as $post): ?>
            <li>
                <strong><?php echo $post['username']; ?></strong>: <?php echo $post['content']; ?>
                <?php if(!empty($post['image_path'])): ?>
                    <img src="<?php echo $post['image_path']; ?>" alt="Image">
                <?php endif; ?>
                <?php if ($is_admin): ?>
                    <form action="delete_post.php" method="post">
                        <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                        <button type="submit" name="delete">Supprimer</button>
                    </form>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="index.php">Retour à la page de publication</a>
</body>
</html>