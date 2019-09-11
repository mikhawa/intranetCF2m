<?php


	$utilisateurManager = new lutilisateurManager($db_connect);
	
	if(isset($_POST['lenomutilisateur']) && isset($_POST['lemotdepasse'])) {
		$utilisateur = new lutilisateur($_POST);
		if( $utilisateurManager->connectLutilisateur($utilisateur) ) {
			header('Location: ./');
		} else {
			echo $twig->render("public/homepage.html.twig", ["error_connection" => 'Votre nom d\'utilisateur ou votre login est erroné. Veuillez retenter.']);
		}
	} else {
	
// page d'accueil

    // lien vers la page d'accueil
	
	echo $twig->render("public/homepage.html.twig");

	}
