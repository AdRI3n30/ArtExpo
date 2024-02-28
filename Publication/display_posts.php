<?php
// Inclusion du fichier de connexion à la base de données
require_once 'database.php';

// Requête SQL pour récupérer toutes les publications
$sql = "SELECT * FROM posts ORDER BY created_at DESC";
$stmt = $pdo->query($sql);
$posts = $stmt->fetchAll();
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
            <li><?php echo $post['content']; ?></li>
        <?php endforeach; ?>
    </ul>
    <a href="index.php">Retour à la page de publication</a>
</body>
</html>