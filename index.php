<?php

// Fonction pour charger la page demandée
function route($page)
{
    // Liste des pages autorisées
    $allowedPages = ['ART', 'inscription', 'connexion', 'contact'];

    // Vérifier si la page demandée est autorisée
    if (in_array($page, $allowedPages)) {
        // Charger la page HTML correspondante
        if ($page == 'connexion' || $page == 'inscription'|| $page == 'contact') {
            include($page . '/' . $page . '.html');
        } else {
            include($page . '.html');
        }
    } else {
        include('404.html'); // Page non trouvée
    }
}

// Récupérer la partie de l'URL après le nom du domaine
$request = trim($_SERVER['REQUEST_URI'], '/');

// Si l'URL est vide, rediriger vers la page d'accueil
if ($request === '') {
    route('ART');
} else {
    route($request);

    // Réinitialiser l'URL si la page demandée est la page d'accueil
    if ($request == 'ART') {
        echo '<script>window.onload = function() { history.replaceState({}, document.title, "index.php"); }</script>';
    }
}