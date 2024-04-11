<?php
// Inclusion du fichier de connexion à la base de données
require_once '../../Publication/database.php';

// Démarrage de la session
session_start();

// Vérification si l'utilisateur est connecté
if(isset($_SESSION['user_id'])) {
    // Requête SQL pour récupérer les publications avec la catégorie et le pseudo de l'utilisateur qui les a créées
    $sql = "SELECT posts.*, users.username, categories.name
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
}
?>

<!-- Affichage des publications par catégorie -->
<header class="header">
    <div class="overlap-3">
        <a href="/"><button class="butlogo"> <img class="logo" src="/img/LOGO PAPILLON.webp" /> </button></a>
    </div>
    <p class="titre">Musique</p> 
</header> 
<div class="videopage">
    <?php foreach($posts_by_category['Musique'] ?? [] as $post): ?>
    <div class="video">
        <!-- Afficher le contenu de la publication -->
        <h2><?php echo $post['content']; ?></h2>
        <?php if(!empty($post['image_path'])): ?>
            <!-- Afficher l'image de la publication -->
            <?php $image_url = "http://artexpo/Publication/" . $post['image_path']; ?>
            <img src="<?php echo $image_url; ?>" alt="Image">
        <?php endif; ?>
         <!-- Afficher le nombre de likes et le formulaire de like seulement si l'utilisateur est connecté -->
         <?php if(isset($_SESSION['user_id'])): ?>
            <p>Nombre de likes : <?php echo isset($post['likes']) ? $post['likes'] : 0; ?></p>
            <form action="../../Publication/like_post.php" method="post">
                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                <button type="submit" name="like">Like</button>
            </form>
         <?php endif; ?>
        <!-- Afficher les commentaires -->
        <h3>Commentaires :</h3>
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
                echo "<p><strong>{$comment_row['comment_username']}</strong>: {$comment_row['message']}</p>";
            }
        } else {
            echo "<p>Aucun commentaire pour cette publication.</p>";
        }

        // Libérer la mémoire utilisée par le résultat des commentaires
        $comment_result->free();
        ?>
        <?php if(isset($_SESSION['user_id'])): ?>
            <form action="../../Publication/save_comment.php" method="post">
                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                <textarea name="message" placeholder="Entrez votre commentaire ici"></textarea>
                <button type="submit">Poster le commentaire</button>
            </form>
         <?php endif; ?>
    </div>
    <?php endforeach; ?>
</div>
