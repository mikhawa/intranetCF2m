<?php

class pagination{

   public static function page(int $nbTotalElement, int $nbPage, string $variableGet){

       $sortie="";

   $nbPages = ceil($nbTotalElement/$nbPage);
        if($nbPages==1){


         }else{
            $sortie.="<div>";
            for($i=1; $i<+$nbPages;$i++){
                $sortie.= "<a href='?$variableGet=$i'>$i</a>";
            }

         }







   }




}