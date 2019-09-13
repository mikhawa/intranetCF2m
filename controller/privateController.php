<?php

<<<<<<< HEAD
if (isset($_GET['deconnect'])) {
=======
$utilisateurManager=new lutilisateurManager($db_connect);

if(isset($_GET['deconnect'])){
>>>>>>> d5df8bca2edc6dbb20ec0ad151c8aae6de02a2f5

    $lutilisateurM->deconnectLutilisateur();

<<<<<<< HEAD
} elseif (isset($_GET['stagiaireContorller === 1'])) {

    require_once "../controller/roles/stagiaireContorller.php";

} elseif (isset($_GET['superAdminController === 2'])) {

    require_once "../controller/roles/superAdminController.php";

} elseif (isset($_GET['accueilController === 3'])) {

    require_once "../controller/roles/accueilController.php";

} elseif (isset($_GET['referentController === 4'])) {

    require_once "../controller/roles/referentController.php";

} elseif (isset($_GET['personelController === 5'])) {

    require_once "../controller/roles/personelController.php";

=======
}

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
>>>>>>> d5df8bca2edc6dbb20ec0ad151c8aae6de02a2f5
}
