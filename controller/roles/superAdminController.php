<?php
	if( isset($_GET['lafiliere']) ) echo $twig->render('lafiliere/lafiliere_afficherliste.html.twig',['session'=>$_SESSION, 'detailfiliere'=>$lafiliereM->selectAllLafiliere()]); else
// on appelle l'a vue générée par twig l'accueil du superAdmin
    echo $twig->render('roles/admin/admin_homepage.html.twig',['session'=>$_SESSION]);

