<?php
var_dump($_SESSION);
if(isset($_GET['deconnect'])){

	$theuserM->deconnecterSession();

}elseif(isset($_GET['stagiaireContorller'])){

    require_once "../controller/roles/stagiaireContorller.php";

}elseif(isset($_GET['superAdminController'])){

    require_once "../controller/roles/superAdminController.php";

}elseif(isset($_GET['accueilController'])){

    require_once "../controller/roles/accueilController.php";

}elseif(isset($_GET['referentController'])){

    require_once "../controller/roles/referentController.php";

}elseif(isset($_GET['personelController'])){

    require_once "../controller/roles/personelController.php";

}