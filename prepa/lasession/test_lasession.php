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

	if( isset($_GET['viewlasession']) ) {
		echo $twig->render("lasession/lasession_afficherliste.html.twig", ['detailsession'=>$lasessionManager->sessionSelectALL()]);
	} 
	elseif ( isset($_GET['updatelasession']) && ctype_digit($_GET['updatelasession']) ) {
		echo $twig->render("lasession/lasession_modifier.html.twig", ['detailsession'=>$lasessionManager->sessionSelectByID($_GET['updatelasession'])]);
	} 
	elseif ( isset($_GET['insertlasession']) ) {
		echo $twig->render("lasession/lasession_ajouter.html.twig");
	} 
	elseif ( isset($_GET['deletelasession']) && ctype_digit($_GET['deletelasession'])) {
		$db_connect->exec('DELETE FROM lasession WHERE idlasession = ' . $_GET['deletelasession']);
	}