<?php

class rechercheStagiaire{


public static function researchStagiaire(){

     //require_once '../config.php';

     //require_once 'index.php';

         
        /*if (isset($_POST['param'])) {
            $demande = $_POST['param'];
        
            if (!empty($data)) {
                // variable contenant la requête MySQL
                $sql1 = 'SELECT u.lenom, u.leprenom, s.lacronyme
                FROM lutilisateur u
                INNER JOIN linscription i
                ON i.utilisateur_idutilisateur = u.idlutilisateur
                INNER JOIN lasession s
                ON s.idlasession = i.lasession_idsession
                WHERE (u.lenom  
                LIKE "%?%") 
                OR (u.leprenom
                LIKE "%?%")
                ORDER BY s.lacronyme';
                 
                 var_dump($data);
        
                // exécution de la requête
                $recup = $db->prepare($sql1);
                $recup->bindValue(1,$data,PDO::PARAM_STR);
                $recup->bindValue(2,$data,PDO::PARAM_STR);
                $recup->execute();
        
        
                        if ($recup->rowCount() === 0) {
                            return [];
                        }
                        return $recup->fetch(PDO::FETCH_ASSOC);*/

        
                while ($row = $recup->fetchAll(PDO::FETCH_ASSOC)){
                    $resultset[] = $row["leprenom"]." ".$row["lenom"]." ".$row["lacronyme"];
                
                
                if (!empty($resultset)) {
                    $chaineretour = json_encode($resultset);
                } else {
                    $chaineretour = json_encode("");
                }
                echo $chaineretour;

        
                
            }
         }

        }
    //}
     
}