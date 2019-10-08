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
	
	// Load managers
	$lasessionM = new lasessionManager($db_connect);
	$lafiliereM = new lafiliereManager($db_connect);
	
	
	// Delete, Update, Insert conditions
	if( isset($_GET['confirmationdeletelasession']) && ctype_digit($_GET['confirmationdeletelasession']) ) {
		$lasessionM->sessionDelete($_GET['confirmationdeletelasession']);
	} 
	else if( isset($_POST['idlasession']) && ctype_digit($_POST['idlasession']) && isset($_POST['lenom']) && isset($_POST['lacronyme']) && isset($_POST['lannee']) && ctype_digit($_POST['lannee']) && isset($_POST['lenumero']) && ctype_digit($_POST['lenumero']) && isset($_POST['letype']) && ctype_digit($_POST['letype']) && isset($_POST['debut']) && isset($_POST['fin']) && isset($_POST['lafiliere_idfiliere']) && ctype_digit($_POST['lafiliere_idfiliere']) ) {
		$lasession = new lasession($_POST);
		$lasessionM->sessionUpdate($lasession);
	} 
	else if( isset($_POST['lenom']) && isset($_POST['lacronyme']) && isset($_POST['lannee']) && ctype_digit($_POST['lannee']) && isset($_POST['lenumero']) && ctype_digit($_POST['lenumero']) && isset($_POST['letype']) && ctype_digit($_POST['letype']) && isset($_POST['debut']) && isset($_POST['fin']) && isset($_POST['lafiliere_idfiliere']) && ctype_digit($_POST['lafiliere_idfiliere']) ) {
		$lasession = new lasession($_POST);
		$lasessionM->sessionCreate($lasession);
	}
	
	
	// Display views
	if( isset($_GET['viewlasession']) ) {
		echo $twig->render("lasession/lasession_afficherliste.html.twig", ['detailsession'=>$lasessionM->sessionSelectALL()]);
	} 
	elseif ( isset($_GET['updatelasession']) && ctype_digit($_GET['updatelasession']) ) {
		echo $twig->render("lasession/lasession_modifier.html.twig", ['detailsession'=>$lasessionM->sessionSelectByID($_GET['updatelasession']), "filieres" => $lafiliereM->filiereSelectAll()]);
	} 
	elseif ( isset($_GET['insertlasession']) ) {
		echo $twig->render("lasession/lasession_ajouter.html.twig", ["filieres" => $lafiliereM->filiereSelectAll()]);
	}