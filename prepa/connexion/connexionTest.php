<?php

	include_once '../../config.php';
	
	spl_autoload_register(function ($class) {
    include '../../model/' . $class . '.php';
});
	
	$db_connect = new MyPDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME .';port=' . DB_PORT .';charset=' . DB_CHARSET,
        DB_LOGIN,
        DB_PWD,
        null,
        PRODUCT);
		
	
	$test = new lutilisateurManager($db_connect);

	if(isset($_POST['login']) && isset($_POST['password'])) {
		$connectionStatus = $test->connectLutilisateur($_POST['login'], $_POST['password']);
		var_dump($connectionStatus);
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Test connexion</title>
	<meta charset='utf8'>
</head>
<body>
	<form method='POST'>
		<fieldset>
			<legend>Connexion</legend>
			<label for='login'>Login</label><br><input id='login' name='login'><br><br>
			<label for='password'>Password</label><br><input id='password' type='password' name='password'><br><br>
			<button type='submit'>Connexion</button>
		</fieldset>
	</form>
</body>
</html>