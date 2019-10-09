<?php

class lafiliereManager {

    private $db;

    public function __construct(MyPDO $connect) {
        $this->db = $connect;
    }

    public function displayContentLafiliere(): array {
        $sql = "
		DESCRIBE
			lafiliere;";
        $sqlQuery = $this->db->prepare($sql);
        $sqlQuery->execute();

        return $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
    }

    public function filiereSelectAll(): array {

        $sql = "SELECT * FROM lafiliere  ;";
        $recup = $this->db->query($sql);

        if ($recup->rowCount() === 0) {
            return [];
        }
        return $recup->fetchAll(PDO::FETCH_ASSOC);
    }

    public function filiereSelectById(int $idlafiliere): array {
        if (empty($idlafiliere)) {
            return[];
        }

        $sql = "SELECT * FROM lafiliere WHERE idlafiliere = ? ;";
        $recup = $this->db->prepare($sql);

        $recup->bindValue(1, $idlafiliere, PDO::PARAM_INT);

        $recup->execute();

        if ($recup->rowCount() === 0) {
            return [];
        }
        return $recup->fetch(PDO::FETCH_ASSOC);
    }

    public function filiereCreate(lafiliere $datas) {

       

        $sql = "INSERT INTO lafiliere (lenom, lacronyme, lacouleur, lepicto) VALUES (?,?,?,?);";

        $insert = $this->db->prepare($sql);

        $insert->bindValue(1, $datas->getLenom(), PDO::PARAM_STR);
        $insert->bindValue(2, $datas->getLacronyme(), PDO::PARAM_STR);
        $insert->bindValue(3, $datas->getLacouleur(), PDO::PARAM_STR);
        $insert->bindValue(4, $datas->getLepicto(), PDO::PARAM_STR);
        


        try {
            $insert->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getCode();
            return false;
        }
    
    }

        function uploadFichier(array $datas){

            
    
            $dossier = 'img/upload/';
            $fichier = basename($datas['name']);
            $taille_maxi = 1000000;
            $taille = filesize($datas['tmp_name']);
            $extensions = array('.png', '.gif', '.jpg', '.jpeg');
            $extension = strrchr($datas['name'], '.'); 
            //Début des vérifications de sécurité...
            if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
            {
                $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
            }
            if($taille>$taille_maxi)
            {
                $erreur = 'Le fichier est trop gros...';
            }
            if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
            {
                //On formate le nom du fichier ici...
                $fichier = strtr($fichier, 
                    'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                    'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
                if(move_uploaded_file($datas['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
                {
                    echo 'Upload effectué avec succès !';
                }
                else //Sinon (la fonction renvoie FALSE).
                {
                    echo 'Echec de l\'upload !';
                }
            }
            else
            {
                echo $erreur;
            }
    
        }
    

    public function filiereUpdate(lafiliere $datas, int $get) {

        if (empty($datas->getlenom()) || empty($datas->getlacronyme()) || empty($datas->getidlafiliere()) || empty($datas->getLacouleur()) || empty($datas->getLepicto())) {
            return false;
        }

        if ($datas->getidlafiliere() != $get) {
            return false;
        }


        $sql = "UPDATE lafiliere SET lenom=?, lacronyme=?, lacouleur=?, lepicto=? WHERE idlafiliere=?;";
        $update = $this->db->prepare($sql);

        $update->bindValue(1, $datas->getlenom(), PDO::PARAM_STR);
        $update->bindValue(2, $datas->getlacronyme(), PDO::PARAM_STR);
        $update->bindValue(3, $datas->getLacouleur(), PDO::PARAM_STR);
        $update->bindValue(4, $datas->getLepicto(), PDO::PARAM_STR);
        $update->bindValue(5, $datas->getIdlafiliere(), PDO::PARAM_INT);
        

        try {
            $update->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getCode();
            return false;
        }
    }

    public function filiereDelete(int $idlafiliere) {

        $sql = "DELETE FROM lafiliere WHERE idlafiliere=?";

        $delete = $this->db->prepare($sql);
        $delete->bindValue(1, $idlafiliere, PDO::PARAM_INT);

        try {
            $delete->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getCode();
            return false;
        }
    }




/*
UPLOAD de fichiers
*/

    

}