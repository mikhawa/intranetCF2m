<?php

class pagination{

   public static function page($messageParPage){

   $messageParPage = 5;

      if(isset($_GET['suite1'])){

        echo $twig->render(lerole/lerole_page2.html.twig);


      }else{
        header("Location: ./");
      }







   }




}