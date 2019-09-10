<?php


	$utilisateurManager = new lutilisateurManager($db_connect);
	
	if(isset($_POST['lenomutilisateur']) && isset($_POST['lemotdepasse'])) {
		$utilisateur = new lutilisateur($_POST);
		$connectionStatus = $utilisateurManager->connectLutilisateur($utilisateur);
		header("Location: ./");
	}
	
// page d'accueil

    // lien vers la page d'accueil
    echo $twig->render("public/homepage.html.twig");


