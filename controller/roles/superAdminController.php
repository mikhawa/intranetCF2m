<?php

    if( isset($_GET['viewlafiliere']) ) {
        echo $twig->render('lafiliere/lafiliere_afficherliste.html.twig',['session'=>$_SESSION, 'detailfiliere'=>$lafiliereM->filiereSelectAll()]); 
    }
    else if (isset($_GET['insertlafiliere'])) {

        

        echo $twig->render('lafiliere/lafiliere_ajouter.html.twig');
    }
    else { // on appelle la vue générée par twig l'accueil du superAdmin
        echo $twig->render('roles/admin/admin_homepage.html.twig',['session'=>$_SESSION]);
    }
