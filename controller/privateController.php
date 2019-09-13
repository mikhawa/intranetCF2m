<?php

if (isset($_GET['deconnect'])) {

    $lutilisateurM->deconnectLutilisateur();

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

}
