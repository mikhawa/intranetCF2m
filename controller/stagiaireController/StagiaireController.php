<?php

if(isset($_GET['stagiaire']) && ctype_digit($_GET['stagiaire'])){

$stagiaire  =(int) $_GET['stagiaire'];

$stagiaire = $theStagiaireM->creerMenu($stagiaire);

echo $twig->render("view/theStagiaire.html.twig",["lemenu"=>$lemenu,"stagiaire"=>$stagiaire]);

}
