<?php
// Inclusion du fichier de connexion à la base de données
require_once 'database.php';

// Requête SQL pour récupérer toutes les publications
$sql = "SELECT * FROM posts ORDER BY created_at DESC";
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
                <?php echo $post['content']; ?>
                <?php if(!empty($post['image_path'])): ?>
                    <img src="<?php echo $post['image_path']; ?>" alt="Image">
                <?php endif; ?>
                <form action="delete_post.php" method="post">
                    <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                    <button type="submit" name="delete">Supprimer</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="index.php">Retour à la page de publication</a>
</body>
</html>