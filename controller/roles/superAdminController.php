<?php

if (isset($_GET['viewlafiliere'])) {
    
    echo $twig->render('lafiliere/lafiliere_afficherliste.html.twig', ['detailfiliere' => $lafiliereM->filiereSelectAll()]);
    
} elseif (isset($_GET['insertlafiliere'])) {

    if (isset($_POST['lenom'])) {
        $newfiliere = new lafiliere($_POST);
        $insert = $lafiliereM->filiereCreate($newfiliere);
        header("Location: ./");
    }

    echo $twig->render('lafiliere/lafiliere_ajouter.html.twig');
    
} elseif (isset($_GET['deletelafiliere']) && ctype_digit($_GET['deletelafiliere'])) {

    $idlafiliere = (int) $_GET['deletelafiliere'];

    if (isset($_GET['ok'])) {
        
        $lafiliereM->filiereDelete($idlafiliere);

        header("Location: ./");
        
    } else {
        
        echo $twig->render('lafiliere/lafiliere_delete.html.twig', ['id' => $idlafiliere]);
    }
} else if (isset($_GET["updatelafiliere"]) && ctype_digit($_GET["updatelafiliere"])) {
    
    if(isset($_POST['idlafiliere'])){
        $updatelafiliere = new lafiliere($_POST);
        
    }else{
        
    echo $twig->render('lafiliere/lafiliere_modifier.html.twig', ['section' => $lafiliereM->filiereSelectById($_GET['updatelafiliere'])]);
    }   
} else {

    echo $twig->render('roles/admin/admin_homepage.html.twig', ['session' => $_SESSION]);
}

