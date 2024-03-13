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
} else {
    // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: login.php");
    exit();
}
?>

<!-- Affichage des publications par catégorie -->
<header class="header">
    <div class="overlap-3">
        <a href="/"><button class="butlogo"> <img class="logo" src="/img/LOGO PAPILLON.webp" /> </button></a>
    </div>
    <p class="titre">Photos</p> 
</header> 
<div class="videopage">
    <?php foreach($posts_by_category['Photos'] ?? [] as $post): ?>
        <div class="video">
            <!-- Afficher l'image de la publication -->
            <?php if(!empty($post['image_path'])): ?>
                <!-- Construire l'URL complète de l'image -->
                <?php $image_url = "http://artexpo/Publication/" . $post['image_path']; ?>
                <img src="<?php echo $image_url; ?>" alt="Image">
            <?php endif; ?>
            <!-- Afficher le titre de la publication -->
            <h2><?php echo $post['content']; ?></h2>
        </div>
    <?php endforeach; ?>
</div>
