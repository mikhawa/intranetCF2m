<?php



class rechercheStagiaire{


    public static function searchStagiaire($data) {

        
            if (!empty($data)) {
                // variable contenant la requête MySQL
                $sql1 = 'SELECT u.lenom, u.leprenom, s.lacronyme
                FROM lutilisateur u
                INNER JOIN linscription i
                ON i.utilisateur_idutilisateur = u.idlutilisateur
                INNER JOIN lasession s
                ON s.idlasession = i.lasession_idsession
                WHERE (u.lenom  
                LIKE " % :nom %") 
                OR (u.leprenom
                LIKE "% :nom %")
                ORDER BY s.lacronyme';

        
                // exécution de la requête
                $recup = $sql1->prepare();
                $recup->bindValue("nom",$data,PDO::PARAM_STR);
                $recup->execute();
        
        
                        if ($recup->rowCount() === 0) {
                            return [];
                        }
                       // return $recup->fetch(PDO::FETCH_ASSOC);

        
                while ($row = $recup->fetch(PDO::FETCH_ASSOC)){
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



    }

