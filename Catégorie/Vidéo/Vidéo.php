<?php
// Inclusion du fichier de connexion à la base de données
require_once '../../Publication/database.php';

// Démarrage de la session
session_start();

// Vérification si l'utilisateur est connecté

// Requête SQL pour récupérer les publications avec la catégorie et le pseudo de l'utilisateur qui les a créées
$sql = "SELECT posts.*, users.username, categories.name,  posts.titre
        FROM posts 
        JOIN users ON posts.user_id = users.id
        JOIN categories ON posts.category_id = categories.id
        ORDER BY posts.created_at DESC";
$result = $mysqli->query($sql);

// Vérifier si la requête a réussi
if ($result) {
    // Initialisation d'un tableau pour stocker les publications par catégorie
    $posts_by_category = [];

    // Parcours des résultats et stockage des publications dans le tableau par catégorie
    while ($row = $result->fetch_assoc()) {
        $category_name = $row['name'];
        $posts_by_category[$category_name][] = $row;
    }

    // Libération de la mémoire utilisée par le résultat
    $result->free();
} else {
    // Gestion des erreurs de requête
    echo "Erreur de requête : " . $mysqli->error;
}

// Vérification si $_SESSION['is_admin'] est défini
$is_admin = isset($_SESSION['is_admin']) ? $_SESSION['is_admin'] : false;
?>


<!-- Affichage des publications par catégorie -->
<head>
    <link rel="stylesheet" href="../../css/header.css" />
    <link rel="stylesheet" href="../../css/main.css" />
    <link rel="stylesheet" href="../../css/index2.css" />
    <link rel="icon" type="image/x-icon" href="../../img/Logonobg.png">
    <title>ArtExpo - Vidéo</title>
</head>
<body>
    <div class="HeaderHaut">
        <div class="logo" id="logo"><a href="/"><img src="../../img/Logonobg.png" alt=""></a></div>
        <div class="navbar">
            <a href="/">Accueil</a>
            <a href="/Catégorie/Contact/Contact.php">Contact</a>
            <?php
                    if ($_SESSION["login"] == "false") {
                        echo '<a href="/connexion/connexion.php">Connexion</a>';
                    } else{
                        if ($_SESSION["is_admin"] == 1) {
                            echo'<a href="/Publication/index.php">Post</a>';
                            echo '<a href="/Admin/admin-lobby.php">Admin</a>';
                            echo '<a href="/Profil/Profil.php">Profil</a>';
                        } else {
                            echo'<a href="/Publication/index.php">Post</a>';
                             echo '<a href="/Profil/Profil.php">Profil</a>';
                            } 
                    }
                ?>
        </div>
    </div>
    <div class="HeaderBas">
    <a href="/Catégorie/Musique/Music.php">Musique</a>
        <a href="/Catégorie/Théâtre/Théâtre.php">Théatre</a>
        <a href="/Catégorie/Vidéo/Vidéo.php">Vidéo</a>
        <a href="/Catégorie/Photos/Photo.php">Photo</a>
        <a href="/Catégorie/Tableaux/Tableau.php">Tableau</a>
    </div>
    <div class="container">
    <?php foreach($posts_by_category['Vidéo'] ?? [] as $post): ?>
        <div id="glassmorph" class="text2">
                <div><h1><?php echo $post['titre']; ?></h1></div>
                <!-- Afficher l'image de la publication -->
                <?php if(!empty($post['video_path'])): ?>
                    <!-- Construire l'URL complète de l'image -->
                    <?php $video_url = "http://artexpo/Publication/" . $post['video_path']; ?>
                    <div class="content"> 
                        <div class="video-container">
                        <video controls>
                            <source src="<?php echo $video_url; ?>" type="video/mp4"></div>
                        </video>
                    </div>
                <?php endif; ?>
                <!-- Afficher le titre de la publication -->
                <div class="bubble">        
                    <p><?php echo $post['content']; ?></p>
                </div>  
                <p>Nombre de likes : <?php echo isset($post['likes']) ? $post['likes'] : 0; ?></p> 
                <?php if($_SESSION["login"] == "True"): ?>
                    <form action="../../Publication/like_post.php" method="post">
                        <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                        <div class="buttons2">
                            <button type="submit" name="like">Like</button>
                        </div>
                    </form>
                <?php endif; ?>
                <!-- Afficher les commentaires -->
                <div class="buttons">
                    <button class="comment-button">Commentaires</button>
                </div>
                <div class="comments-container">
                    <?php
                    // Requête SQL pour récupérer les commentaires associés à cette publication
                    $comment_sql = "SELECT comments.*, users.username AS comment_username
                                    FROM comments 
                                    JOIN users ON comments.user_id = users.id
                                    WHERE comments.post_id = ?";
                    $comment_stmt = $mysqli->prepare($comment_sql);
                    if(!$comment_stmt) {
                        die("Erreur de préparation de la requête: " . $mysqli->error);
                    }
                    $post_id = $post['id']; // L'ID de la publication actuelle
                    $comment_stmt->bind_param("i", $post_id);
                    $comment_stmt->execute();
                    $comment_result = $comment_stmt->get_result();

                    // Afficher les commentaires s'il y en a
                    if ($comment_result->num_rows > 0) {
                        while ($comment_row = $comment_result->fetch_assoc()) {
                            echo "<p class=\"commentaire-text\">{$comment_row['comment_username']}: {$comment_row['message']}</p>";
                        }
                    } else {
                        echo "<p>Aucun commentaire pour cette publication.</p>";
                    }

                    // Libérer la mémoire utilisée par le résultat des commentaires
                    $comment_result->free();
                    ?>
                    <?php if($_SESSION["login"] == "True"): ?>
                        <form action="../../Publication/save_comment.php" method="post">
                            <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                            <textarea name="message" placeholder="Entrez votre commentaire ici"></textarea>
                            <div class="buttons3">
                                <button type="submit">Poster le commentaire</button>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>    
            </div>
        <?php endforeach; ?>
    </div>
    <script src="../../JS/Newfyp.js"></script>
</body>
