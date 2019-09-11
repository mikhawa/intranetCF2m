<?php

var_dump($_SESSION);

if(isset($_GET['deconnect'])){

	$theuserM->deconnecterSession();

}

switch ($_SESSION['role']) {
    case "1":
        include "roles/personnelController.php";
        break;
    case "2":
        include "roles/accueilController.php";
        break;
    case "3":
        include "roles/pedagogiqueController.php";
        break;
    case "4":
        include "roles/superAdmniController.php";
        break;
    case "5":
        include "roles/stagiaireController.php";
        break;
    default:
        echo "Session introuvable";
}
