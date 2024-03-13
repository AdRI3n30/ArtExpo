<!DOCTYPE html>
<html>
<head>
    <title>Page de Publication</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h2>Publier quelque chose</h2>
    <form action="process_post.php" method="post" enctype="multipart/form-data">
        <textarea name="content" placeholder="Saisissez votre publication ici" required></textarea>
        <input type="file" name="image">
        <input type="submit" name="submit" value="Publier"><br>
        <label for="category">Catégorie :</label>
        <select name="category" id="category">
            <?php
            // Inclure le fichier de connexion à la base de données
            require_once 'database.php';

            // Requête SQL pour récupérer toutes les catégories
            $sql = "SELECT * FROM categories";
            $result = $mysqli->query($sql);

            // Parcourir les résultats et afficher les options de la liste déroulante
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['name']}</option>";
            }
            ?>
        </select><br>
    </form>
    <a href="display_posts.php">Voir les publications</a>
</body>
</html>