<?php

/*
 * Importation des modules accessible à l'administrateur technique
 */

if(!empty($_GET)){


// gestion de lafiliere
require_once "../controller/modules/gestionLafiliere.php";
// gestion de lasession
    require_once "../controller/modules/gestionLasession.php";


// Delete, Update, Insert conditions for congés

if (isset($_GET['confirmationdeleteleconge']) && ctype_digit($_GET['confirmationdeleteleconge'])) {
    $lecongeM->deleteConge($_GET['confirmationdeleteleconge']);
// Update
} else if (isset($_POST['idleconge']) && ctype_digit($_POST['idleconge']) && isset($_POST['debut']) && isset($_POST['fin']) && isset($_POST['letype']) && ctype_digit($_POST['letype']) && isset($_POST['lasession_idlasession']) && ctype_digit($_POST['lasession_idlasession'])) {
    $leconge = new leconge($_POST);
    $lecongeM->updateConge($leconge);
// INSERT
} else if (isset($_POST['debut']) && isset($_POST['fin']) && isset($_POST['letype']) && ctype_digit($_POST['letype']) && isset($_POST['lasession_idlasession']) && ctype_digit($_POST['lasession_idlasession'])) {
    $leconge = new leconge($_POST);
    $lecongeM->lecongeCreate($leconge);
	header('Location: ./?viewleconge');
}
// Insert conditions for inscriptions
if (isset($_POST['debut']) && isset($_POST['fin']) && isset($_POST['utilisateurIdutilisateur']) && ctype_digit($_POST['utilisateurIdutilisateur']) && isset($_POST['lasessionIdsession']) && ctype_digit($_POST['lasessionIdsession'])) {
    $linscription = new linscription($_POST);
    $linscriptionM->linscriptionCreate($linscription);
}
 
// Display views for conges
if (isset($_GET['viewleconge'])) {
	$paginConge = (isset($_GET['pgConge'])?(int)$_GET['pgConge']:1);
    $nbConge = $lecongeM->selectCongeCountById();
    $nbPageConge = $lecongeM->selectCongeWithLimit($paginConge,5);
    $PaginationConge = pagination::pagine($nbConge,5,$paginConge,"viewleconge&pgConge");
	
	echo $twig->render("leconge/leconge_afficherliste.html.twig", ['detailConge' => $nbPageConge,"pagination"=>$PaginationConge]);
	
}
elseif (isset($_GET['updateleconge']) && ctype_digit($_GET['updateleconge']))
{
    echo $twig->render("leconge/leconge_modifier.html.twig", ['detailConge' => $lecongeM->lecongeSelectByld($_GET['updateleconge']), "sessions" => $lasessionM->sessionSelectALL()]);
}
elseif (isset($_GET['insertleconge']))
{
    echo $twig->render("leconge/leconge_ajouter.html.twig", ["sessions" => $lasessionM->sessionSelectALL()]);
      
	  
      
//insert un nouveau rôle
} elseif(isset($_GET['insertLeRole'])){
    if(!empty($_POST)){
        $newLeRole = new lerole($_POST);
        echo $twig->render('lerole/lerole_ajouter.html.twig',['lintitule'=>$leroleM->insertLerole($newLeRole)]);
      header('Location: ./?viewlerole');
        }
          
    
    else{
        echo $twig->render('lerole/lerole_ajouter.html.twig');
    
    }
//update un rôle
    
}elseif(isset($_GET['updateLeRole']) && ctype_digit($_GET['updateLeRole'])){
    if(isset($_POST['idlerole'])){
        $updateLeRole = new lerole($_POST);
        $leroleM->updateLerole($updateLeRole);
        header("Location: ./?viewlerole");
    }else{
        echo $twig->render('lerole/lerole_modifier.html.twig',['section'=>$leroleM->roleSelectById($_GET['updateLeRole'])]);
    }
//delete le role
}elseif(isset($_GET['deleteLeRole']) && ctype_digit($_GET['deleteLeRole'])){
    $idDeleteRole = (int)$_GET['deleteLeRole'];
    if(isset($_GET['ok'])){
        $leroleM->deleteLerole($idDeleteRole);
        header("Location: ./?viewlerole");
      
      
      }else{
    echo $twig->render('lerole/lerole_delete.html.twig',['id'=>$idDeleteRole]);
    }
  
  
//inscription
  
}elseif (isset($_GET["viewlinscription"])) {
    echo $twig->render("linscription/linscription_afficherliste.html.twig", ['detailinscription' => $linscriptionM->selectAllLinscription()]);
}elseif (isset($_GET["ajouterlinscription"])) {
    echo $twig->render("linscription/linscription_ajouter.html.twig", ['detailUsers' => $lutilisateurM->lutilisateurSelectAll(), 'detailSession' => $lasessionM->sessionSelectALL()]);
}elseif (isset($_GET["updatelinscription"])) {
    echo $twig->render("linscription/linscription_modifier.html.twig", ['modifutilisateur' => $lutilisateurM->lutilisateurSelectAll(), 'modifutilisateur' => $lasessionM->sessionSelectALL()]);


}elseif (isset($_GET['viewutilisateur'])){
     $pageLutisateur=(isset($_GET['pglutilisateur']))?(int)$_GET['pglutilisateur']:1;
    $nblutilisateur =$lutilisateurM->selectLutilisateurCountById();
    $vuelutilisateur =$lutilisateurM->selectlutilisateurWithLimit($pageLutisateur,5);
    $pagesLutisateur=pagination::pagine($nblutilisateur,5,$pageLutisateur,"viewutilisateur&pglutilisateur");
   
 echo $twig->render('lutilisateur/lutilisateur_afficher_presence.html.twig',["lutilisateur"=> $vuelutilisateur,"pagination"=>$pagesLutisateur]);
}elseif(isset($_GET['insertutilisateur'])) {
        if (!empty($_POST)) {

            $newlutilisateur = new lutilisateur($_POST);

            echo $twig->render('lutilisateur/lutilisateur_ajouter.html.twig', ['lenom' => $lutilisateurM->lutilisateurCreate($newlutilisateur)]);
            header('Location: ./?viewutilisateur');

        } else {

            echo $twig->render('lutilisateur/lutilisateur_ajouter.html.twig');

        }


    }

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
