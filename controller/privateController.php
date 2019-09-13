<?php


// load lutilisateur manager
$lutilisateurM=new lutilisateurManager($db_connect);

// deconnection
if(isset($_GET['deconnect'])){
	$lutilisateurM->disconnectLutilisateur();

}

// switch suivant l'id des rôles (pour le moment, un rôle, un controleur)
switch ($_SESSION['idlerole']) {
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
        include "roles/superAdminController.php";
        break;
    case "5":
        include "roles/stagiaireController.php";
        break;
    default:
        echo "Session introuvable";
}
