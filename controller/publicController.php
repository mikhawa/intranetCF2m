<?php

	$utilisateurManager = new lutilisateurManager($db_connect);
	
	if(isset($_POST['login']) && isset($_POST['password'])) {
		$connectionStatus = $utilisateurManager->connectLutilisateur($_POST['login'], $_POST['password']);
		if($connectionStatus[0] === True) $_SESSION['TheIdSess'] = session_id();
		header("Location: ./");
	}
	
// page d'accueil

    // lien vers la page d'accueil
    echo $twig->render("public/homepage.html.twig");

