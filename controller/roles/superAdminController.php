<?php
// view all filieres
if (isset($_GET['viewlafiliere'])) {
    
    echo $twig->render('lafiliere/lafiliere_afficherliste.html.twig', ['detailfiliere' => $lafiliereM->filiereSelectAll()]);

// insert a filiere    
} elseif (isset($_GET['insertlafiliere'])) {

    if (isset($_POST['lenom'])) {
        
        $newfiliere = new lafiliere($_POST);
        
        $insert = $lafiliereM->filiereCreate($newfiliere);
        
        header("Location: ./?viewlafiliere");
        exit;
    }

    echo $twig->render('lafiliere/lafiliere_ajouter.html.twig');

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
} else if (isset($_GET["updatelafiliere"]) && ctype_digit($_GET["updatelafiliere"])) {
    
    // submit updating filiere
    if(isset($_POST['idlafiliere'])){
        
        $updatelafiliere = new lafiliere($_POST);
        
        $lafiliereM->filiereUpdate($updatelafiliere,$_GET["updatelafiliere"]);
        
        header("Location: ./?viewlafiliere");
        
    }else{
        
    echo $twig->render('lafiliere/lafiliere_modifier.html.twig', ['section' => $lafiliereM->filiereSelectById($_GET['updatelafiliere'])]);
    }   
} else {

    echo $twig->render('roles/admin/admin_homepage.html.twig', ['session' => $_SESSION]);
}

