<?php
    if( isset($_GET['viewlafiliere'])){
    
    echo $twig->render('lafiliere/lafiliere_afficherliste.html.twig',[ 'detailfiliere'=>$lafiliereM->filiereSelectAll()]); 

    } else if (isset($_GET["updatelafiliere"]) && ctype_digit($_GET["updatelafiliere"])) {
    echo $twig->render('lafiliere/lafiliere_modifier.html.twig',['section'=>$lafiliereM->filiereSelectById($_GET['updatelafiliere'])]);



} else {

    echo $twig->render('roles/admin/admin_homepage.html.twig',['session'=>$_SESSION]);


}

    


