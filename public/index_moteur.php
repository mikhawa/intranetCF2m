<?php
/*
 * 
 * Front Controller
 * 
 * 
 */
/*
 * session start
 */
session_start();
/*
 * configuration
 */
require_once '../config.php';
/*
 
/*
appel du fichier contenant la requête pour l'autocompletion
*/
require_once '../model/rechercheStagiaire.php';



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
/*
 * Pas connecté, donc on veut afficher le contrôleur public
 */
if (!isset($_SESSION['TheIdSess']) || $_SESSION['TheIdSess'] != session_id()) {
    exit();
}

if(!empty($_POST)){
    var_dump($_POST);
}


