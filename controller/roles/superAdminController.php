<?php


    if( isset($_GET['viewlafiliere']) ) {
        echo $twig->render('lafiliere/lafiliere_afficherliste.html.twig',['detailfiliere'=>$lafiliereM->filiereSelectAll()]); 
    }
    else if (isset($_GET['insertlafiliere'])) {

        if(isset($_POST['lenom'])){
            $newfiliere = new lafiliere($_POST);
            $insert = $lafiliereM->filiereCreate($newfiliere);
        }

        echo $twig->render('lafiliere/lafiliere_ajouter.html.twig');
    }
    else { // on appelle la vue générée par twig l'accueil du superAdmin
        echo $twig->render('roles/admin/admin_homepage.html.twig',['session'=>$_SESSION]);
    }


    //delete la filiere

    if(isset($_GET['delete']) && ctype_digit($_GET['delete'])) {
        
        $idlafiliere = (int) $_GET['delete'];

        if (!isset($GET['ok'])){
            $insert = $lafiliereM->filiereDelete($idlafiliere);

            echo $twig->render('lafiliere/lafiliere_delete.html.twig',['session'=>$_SESSION]);
        }else{
            $lafiliereM->deletefilierebyid($idlafiliere);

            header("Location: ./?adminlafiliere");
        }

    }
else if (isset($_GET["updatelafiliere"]) && ctype_digit($_GET["updatelafiliere"])) {
    echo $twig->render('lafiliere/lafiliere_modifier.html.twig',['section'=>$lafiliereM->filiereSelectById($_GET['updatelafiliere'])]);



} else {

    echo $twig->render('roles/admin/admin_homepage.html.twig',['session'=>$_SESSION]);


}


