<?php

if(isset($_GET['viewdetailsession'])) {

    $selectEval = $evaluationM->selectAllFiliereForEval();


     echo $twig->render("view_stagiaires/choix_filiere.html.twig", ['lutilisateur'=>$selectEval]);




}elseif(isset($_GET['choixFiliere']) && ctype_digit($_GET['choixFiliere'])){
    $choixFiliere = (int)$_GET['choixFiliere'];

    $nomStagiaire = $evaluationM->selectAllStagiairesForEval($choixFiliere);

    echo $twig->render("view_stagiaires/choix_stagiaire.html.twig",['lutilisateur'=>$nomStagiaire]);



 }elseif(isset($_GET['profil']) && ctype_digit($_GET['profil'])){

           $profil=(int)$_GET['profil'];

    

            $profilStagiaire = $evaluationM-> selectProfilStagiaire($profil);

            echo $twig->render('view_stagiaires/profil_stagiaire.html.twig',['leprofil'=>$profilStagiaire]);

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