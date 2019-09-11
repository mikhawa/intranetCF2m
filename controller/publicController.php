<?php


	$utilisateurManager = new lutilisateurManager($db_connect);
	
	if(isset($_POST['lenomutilisateur']) && isset($_POST['lemotdepasse'])) {
		$utilisateur = new lutilisateur($_POST);
		if( $connectionStatus = $utilisateurManager->connectLutilisateur($utilisateur) ) {
			header('Location: ./');
		} else {
			$error_connection = 'Votre nom d\'utilisateur ou votre login est erroné. Veuillez retenter.';
		}
	}
	
// page d'accueil

    // lien vers la page d'accueil
	
    if(isset($error_connection)) {
		echo $twig->render("public/homepage.html.twig", ["error_connection" => $error_connection]);
	} else {
		echo $twig->render("public/homepage.html.twig");
	}


