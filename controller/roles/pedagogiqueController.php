<?php

//choix des filières
if(isset($_GET['viewdetailsession'])) {


    $selectEval = $evaluationM->selectAllFiliereForEval();


     echo $twig->render("view_stagiaires/choix_filiere.html.twig", ['lutilisateur'=>$selectEval]);



//choix des stagiaires de la filiere choisie
}elseif(isset($_GET['choixFiliere']) && ctype_digit($_GET['choixFiliere'])){
    $choixFiliere = (int)$_GET['choixFiliere'];

    $nomStagiaire = $evaluationM->selectAllStagiairesForEval($choixFiliere);

    echo $twig->render("view_stagiaires/choix_stagiaire.html.twig",['lutilisateur'=>$nomStagiaire]);


// choix du stagiaire pour voir son profil
 }elseif(isset($_GET['profil']) && ctype_digit($_GET['profil'])){

           $profil=(int)$_GET['profil'];

    

            $profilStagiaire = $evaluationM->selectProfilStagiaire($profil);

            echo $twig->render('view_stagiaires/profil_stagiaire.html.twig',['idlutilisateur'=>$profilStagiaire]);


//update des infos du stagiaire
}elseif(isset($_GET['ajoutInfo']) && ctype_digit($_GET['ajoutInfo'])){

    if(isset($_POST['idlutilisateur'])){

    $updateStagiaire = new evaluation($_POST);

    $evaluationM->updateStagiaire($updateStagiaire);

    header("Location: ./?ajoutInfo");
    
    }else{
       $recupStagiaire= $evaluationM->selectProfilStagiaire($_GET['ajoutInfo']);
        echo $twig->render('view_stagiaires/modifier_stagiaire.html.twig',['section'=>$recupStagiaire]);
        
    }





//vue profils stagiaire - on choisi un stagiaire par son nom ou prenom grâce à l'autocompletion
}elseif(isset($_GET["viewprofil"]) && ctype_digit($_GET["viewprofil"])){

    $stagiaire = $evaluationM->selectProfilStagiaire($_GET["viewprofil"]);

    if(isset($_POST['stagiaire'])){


    $stagiaireProfil = autoCompletion::rechercheUnStagiaire();

    echo $twig->render('view_stagiaires/recherche_stagiaire.html.twig',['recherche'=>$stagiaireProfil, $stagiaire]);
    }


 

}
          



else{


if(!isset($_SESSION['bandeau'])){
    $pourEntree = true;
    $_SESSION['bandeau']=true;
}else{
    $pourEntree = false;
}
echo $twig->render('roles/pedagogique/pedagogique_homepage.html.twig', ['entree' => $pourEntree,"session"=>$_SESSION]);
}