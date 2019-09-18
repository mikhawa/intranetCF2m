<?php

$utilisateurManager = new lutilisateurManager($db_connect);

if (isset($_POST['lenomutilisateur']) && isset($_POST['lemotdepasse'])) {
    $utilisateur = new lutilisateur($_POST);
    if ($utilisateurManager->connectLutilisateur($utilisateur)) {
        header('Location: ./');
    } else {
        echo $twig->render("public/homepage.html.twig", ["error_connection" =>  true ]);
    }
} else {

// page d'accueil

    echo $twig->render("public/homepage.html.twig");
}
