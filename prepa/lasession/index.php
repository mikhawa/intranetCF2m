<?php

	/*
	 * configuration
	 */
	require_once '../../config.php';

	/*
	 * Composer's autoloader
	 * vendor autoload for
	 * - Twig
	 * - Twig extensions
	 */
	require_once '../../vendor/autoload.php';

	/*
	 * autoload for our models (create by ourself)
	 */
	spl_autoload_register(function ($class) {
		include '../../model/' . $class . '.php';
	});

	/*
	 * create a Twig environment into $twig with debug on true for dev and false on prod, '../view/' is the path to find our view
	 */
	$loader = new \Twig\Loader\FilesystemLoader('../../view/');
	$twig = new \Twig\Environment($loader, [
		'debug' => !(PRODUCT),]);

	/*
	 * Twig's extension for text and debug
	 */
	$twig->addExtension(new Twig_Extensions_Extension_Text());
	$twig->addExtension(new \Twig\Extension\DebugExtension());

	/*
	 * create a PDO connection with MyPDO
	 */
	try {
		$db_connect = new MyPDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=' . DB_PORT . ';charset=' . DB_CHARSET,
				DB_LOGIN,
				DB_PWD,
				null,
				PRODUCT);
	} catch (PDOException $e) {
		echo 'Message d\'erreur : ' . $e->getMessage();
		echo '<br>';
		echo 'Code d\'erreur : ' . $e->getCode();
	}
	
	$lasessionManager = new lasessionManager($db_connect);
	$lafiliereManager = new lafiliereManager($db_connect);
	
	
	// Delete, Insert conditions
	if( isset($_GET['confirmationdeletelasession']) && ctype_digit($_GET['confirmationdeletelasession']) ) {
		$lasessionManager->sessionDelete($_GET['confirmationdeletelasession']);
	} else if( isset($_POST['lenom']) && isset($_POST['lacronyme']) && isset($_POST['lannee']) && isset($_POST['lenumero']) && isset($_POST['letype']) && isset($_POST['debut']) && isset($_POST['fin']) && isset($_POST['lafiliere_idfiliere']) ) {
		$lasession = new lasession($_POST);
		var_dump($lasession);
		$lasessionManager->sessionCreate($lasession);
	}
	
	
	// Display views
	if( isset($_GET['viewlasession']) ) {
		echo $twig->render("lasession/lasession_afficherliste.html.twig", ['detailsession'=>$lasessionManager->sessionSelectALL()]);
	} 
	elseif ( isset($_GET['updatelasession']) && ctype_digit($_GET['updatelasession']) ) {
		echo $twig->render("lasession/lasession_modifier.html.twig", ['detailsession'=>$lasessionManager->sessionSelectByID($_GET['updatelasession'])]);
	} 
	elseif ( isset($_GET['insertlasession']) ) {
		echo $twig->render("lasession/lasession_ajouter.html.twig", ["filieres" => $lafiliereManager->filiereSelectAll()]);
	} 
	/*elseif ( isset($_GET['deletelasession']) && ctype_digit($_GET['deletelasession'])) {
		void;
	}*/