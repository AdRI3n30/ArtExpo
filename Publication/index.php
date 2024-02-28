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
        <input type="submit" name="submit" value="Publier">
    </form>
    <a href="display_posts.php">Voir les publications</a>
</body>
</html>