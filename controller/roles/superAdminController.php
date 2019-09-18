<?php
    if( isset($_GET['viewlafiliere'])){
    
    echo $twig->render('lafiliere/lafiliere_afficherliste.html.twig',['session'=>$_SESSION, 'detailfiliere'=>$lafiliereM->filiereSelectAll()]); 

    } else if (isset($_GET["updatelafiliere"]) && ctype_digit($_GET["updatelafiliere"])) {
    echo $twig->render('lafiliere/lafiliere_modifier.html.twig' ,['detail'=>$filierManager]);



} else {

    echo $twig->render('roles/admin/admin_homepage.html.twig',['session'=>$_SESSION]);


}

    


