<?php

/*
 * PROVISOIRE
 *
 * Classe permettant d'afficher la pagination suivant le nombre d'éléments par page
 */
class lapagination
{
    public static function pagine(int $nbTotalElement, int $nbParPage, string $variableGET): string {

        // variable qui va renvoyer le code HTML de la pagination
        $sortie="";

        // on va calculer le nombre de pages nécessaires en divisant le nombre total d'éléments par le nombre par page, le tout arrondit à l'entier supérieur (ceil)
        $nbPages = ceil($nbTotalElement/$nbParPage);

        // si une seule page
        if($nbPages==1){
            // pas de pagination si non nécessaire

        }else{
            $sortie.="<div>";
            for($i=1;$i<=$nbPages;$i++){
                $sortie.= "<a href='?$variableGET=$i'>$i</a> ";
            }
            $sortie.="</div>";
        }
        return $sortie;
    }
}