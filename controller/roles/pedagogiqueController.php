<?php

if(isset($_GET['viewdetailsession'])) {

    $selectEval = $evaluationM->selectAllFiliereForEval();


     echo $twig->render("view_stagiaires/choix_filiere.html.twig", ['lutilisateur'=>$selectEval]);




}elseif(isset($_GET['choixFiliere'])){

    $nomStagiaire = $evaluationM->selectAllStagiairesForEval();

    echo $twig->render("view_stagiaires/choix_stagiaire.html.twig",['lutilisateur'=>$nomStagiaire]);



}elseif(isset($_GET['viewlafiliere'])){
	
	$paginFiliere = (isset($_GET['pgFiliere'])?(int)$_GET['pgFiliere']:1);
    $nbFiliere = $lafiliereM->selectFiliereCountById();
    $nbPageFiliere = $lafiliereM->selectFiliereWithLimitPublic($paginFiliere,5);
    $PaginationFiliere = pagination::pagine($nbFiliere,5,$paginFiliere,"viewlafiliere&pgFiliere");
    echo $twig->render('lafiliere/lafiliere_afficherliste.html.twig', ['detailfiliere' => $nbPageFiliere, "paginationFiliere"=>$PaginationFiliere]);

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