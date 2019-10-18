<?php

/*
 * lasession
 */
// Delete
if (isset($_GET['confirmationdeletelasession']) && ctype_digit($_GET['confirmationdeletelasession'])) {
    $lasessionM->sessionDelete($_GET['confirmationdeletelasession']);
// Update
} else if (isset($_POST['idlasession']) && ctype_digit($_POST['idlasession']) && isset($_POST['lenom']) && isset($_POST['lacronyme']) && isset($_POST['lannee']) && ctype_digit($_POST['lannee']) && isset($_POST['lenumero']) && ctype_digit($_POST['lenumero']) && isset($_POST['letype']) && ctype_digit($_POST['letype']) && isset($_POST['debut']) && isset($_POST['fin']) && isset($_POST['lafiliere_idfiliere']) && ctype_digit($_POST['lafiliere_idfiliere'])) {
    $lasession = new lasession($_POST);
    $lasessionM->sessionUpdate($lasession);
// INSERT
} else if (isset($_POST['lenom']) && isset($_POST['lacronyme']) && isset($_POST['lannee']) && ctype_digit($_POST['lannee']) && isset($_POST['lenumero']) && ctype_digit($_POST['lenumero']) && isset($_POST['letype']) && ctype_digit($_POST['letype']) && isset($_POST['debut']) && isset($_POST['fin']) && isset($_POST['lafiliere_idfiliere']) && ctype_digit($_POST['lafiliere_idfiliere'])) {
    $lasession = new lasession($_POST);
    $lasessionM->sessionCreate($lasession);
}

// view all filieres
if (isset($_GET['viewlafiliere'])) {


    $paginFiliere = (isset($_GET['pgFiliere'])?(int)$_GET['pgFiliere']:1);

    $nbFiliere = $lafiliereM->selectFiliereCountById();

    $nbPageFiliere = $lafiliereM->selectFiliereWithLimit($paginFiliere,5);

    $PaginationFiliere = pagination::pagine($nbFiliere,5,$paginFiliere,"viewlafiliere&pgFiliere");

    echo $twig->render('lafiliere/lafiliere_afficherliste.html.twig', ['detailfiliere' => $nbPageFiliere, "paginationFiliere"=>$PaginationFiliere]);

// insert a filiere    
} elseif (isset($_GET['insertlafiliere'])) {

    if (isset($_POST['lenom'])) {

        $newfiliere = new lafiliere($_POST);
        //s($newfiliere,$_FILES);
        
        // si on attache une nouvelle images
        if ($_FILES['lepicto']['error']!=4) {

            $nouveauNom = uploadDoc::renameDoc($_FILES['lepicto']['name']);
            // changement du nom pour l'insertion dans la db
            $newfiliere->setLepicto($nouveauNom);

            // changement du nom pour l'upload de fichier
            $_FILES['lepicto']['name'] = $nouveauNom;

            // Appel de la classe statique updloadDoc dans laquelle on va chercher la méthode statique uploadFichier avec ::
            $upload = uploadDoc::uploadFichier($_FILES['lepicto'],
                    ['.png', '.gif', '.jpg', '.jpeg'], // on souhaite que des images
                    $folder=IMG_ORIGIN // on les mets dans le dossier imagesoriginales
                    );
            if (!$upload) {
                exit();
            // l'image a bien été envoyée    
            }else{
                // chemin de l'image

                // redimension avec proportion
                uploadDoc::uploadRedim($upload,IMG_MEDIUM,300,300,90);
                // redimension avec crop dans l'iamge
                uploadDoc::uploadThumb($upload,IMG_THUMB,50,50,80);
            }
        }


        // insertion dans la db
        $lafiliereM->filiereCreate($newfiliere);


        //d($newfiliere,$_POST,$_FILES);
       header("Location: ./?viewlafiliere");
    } else {

        echo $twig->render('lafiliere/lafiliere_ajouter.html.twig');
    }



// delete a filiere    
} elseif (isset($_GET['deletelafiliere']) && ctype_digit($_GET['deletelafiliere'])) {

    $idlafiliere = (int) $_GET['deletelafiliere'];

    // validated delete
    if (isset($_GET['ok'])) {

        $lafiliereM->filiereDelete($idlafiliere);

        header("Location: ./?viewlafiliere");
    } else {

        echo $twig->render('lafiliere/lafiliere_delete.html.twig', ['id' => $idlafiliere]);
    }

// update a filiere    
} elseif (isset($_GET["updatelafiliere"]) && ctype_digit($_GET["updatelafiliere"])) {

    // submit updating filiere
    if (isset($_POST['idlafiliere'])) {

        
        $updatelafiliere = new lafiliere($_POST);
        //s($_FILES);
        // si on attache une nouvelle images
        if ($_FILES['lepicto']['error']!=4) {

            $nouveauNom = uploadDoc::renameDoc($_FILES['lepicto']['name']);
            // changement du nom pour l'insertion dans la db
            $updatelafiliere->setLepicto($nouveauNom);

            // changement du nom pour l'upload de fichier
            $_FILES['lepicto']['name'] = $nouveauNom;

            // Appel de la classe statique updloadDoc dans laquelle on va chercher la méthode statique uploadFichier avec ::
            $upload = uploadDoc::uploadFichier($_FILES['lepicto'],['.png', '.gif', '.jpg', '.jpeg'], // on souhaite que des images
                    $folder=IMG_ORIGIN );
            if (!$upload) {
                exit();
            }else{
                // redimension avec proportion
                uploadDoc::uploadRedim($upload,IMG_MEDIUM,300,300,90);
                // redimension avec crop dans l'iamge
                uploadDoc::uploadThumb($upload,IMG_THUMB,50,50,80);
            }
        }
        //s($updatelafiliere);
        $lafiliereM->filiereUpdate($updatelafiliere, $_GET["updatelafiliere"]);
        


        header("Location: ./?viewlafiliere");
    } else {

        echo $twig->render('lafiliere/lafiliere_modifier.html.twig', ['section' => $lafiliereM->filiereSelectById($_GET['updatelafiliere'])]);
    }






// Display views for sessions
} elseif (isset($_GET['viewlasession'])) {
    echo $twig->render("lasession/lasession_afficherliste.html.twig", ['detailsession' => $lasessionM->sessionSelectALL()]);
} elseif (isset($_GET['updatelasession']) && ctype_digit($_GET['updatelasession'])) {
    echo $twig->render("lasession/lasession_modifier.html.twig", ['detailsession' => $lasessionM->sessionSelectByID($_GET['updatelasession']), "filieres" => $lafiliereM->filiereSelectAll()]);
} elseif (isset($_GET['insertlasession'])) {
    echo $twig->render("lasession/lasession_ajouter.html.twig", ["filieres" => $lafiliereM->filiereSelectAll()]);

} elseif(isset($_GET['viewlerole'])) {

    // page actuelle
    $pageactu = (isset ($_GET['pg']))?(int)$_GET['pg']:1;


    // nombre de rôles totaux à afficher
    $nbRoles = $leroleM->selectRoleCountById();


    // on va récupérer les rôles de la page actuelle
    $articlesPageActu = $leroleM->selectRoleWithLimit($pageactu,1);


    // création de la pagination
    $affichePagination = pagination::pagine($nbRoles,1,$pageactu,"viewlerole&pg");

      
      echo $twig->render('lerole/lerole_afficherliste.html.twig', [ "detailrole"=>$articlesPageActu,"pagination"=>$affichePagination]);



      
      

} elseif(isset($_GET[''])){

    






          




}else{

    // si on vient de se connecter la variable de session n'existe pas (donc affuchage du bandeau)
    if(!isset($_SESSION['bandeau'])){
        $pourEntree = true;
        $_SESSION['bandeau']=true;
    }else{
        $pourEntree = false;
    }

    echo $twig->render('roles/admin/admin_homepage.html.twig', ['entree' => $pourEntree,"session"=>$_SESSION]);
}
