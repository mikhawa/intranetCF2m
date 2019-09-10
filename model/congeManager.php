<?php

/*
 * Manageur de l'instance de type "thesection", il peut servir à la création de différentes formes de CRUD, mais également aux actions et interactions entre instances (par exemple afficher les étudiants d'une section)
 */

class congeManager
{
    private $db; // connexion MyPDO (PDO étendue)

    public function __construct(MyPDO $connect ) // passage de la connexion
    {
        $this->db = $connect;
    }

    // actions (méthodes) généralement publiques car exécutées depuis un contrôleur, dont le nom est généralement un verbe, applicable aux instances de thesection

    /*
     *
     *
     * Méthodes pour la partie publique du site
     *
     *
     *
     */

    // création du menu qui nous renvoie un tableau
    public function conge(): array {
        $sql = "SELECT idconge,debut,fin FROM conge ORDER BY debut ASC ;";
        $recup = $this->db->query($sql);

        if($recup->rowCount()===0){
            return [];
        }
            return $recup->fetchAll(PDO::FETCH_ASSOC);


    }

    // création de l'affichage de toutes les sections sur l'accueil publique du site
    public function selectionnerConge(): array {
        $sql = "SELECT * FROM conge ORDER BY debut ASC ;";
        $recup = $this->db->query($sql);

        if($recup->rowCount()===0){
            return [];
        }
            return $recup->fetchAll(PDO::FETCH_ASSOC);

    }

    // récupération d'une section d'après son id (détail des sections)
    public function selectionnerCongeParId(int $idconge): array {
        // si la variable vaut 0 (id ne peux valoir 0 ou la conversion a donné 0)
        if(empty($idconge)){
            return [];
        }
        $sql = "SELECT * FROM conge WHERE idconge = ? ;";
        $recup = $this->db->prepare($sql);
        $recup->bindValue(1,$idsection,PDO::PARAM_INT);
        $recup->execute();

        if($recup->rowCount()===0){
            return [];
        }
        return $recup->fetch(PDO::FETCH_ASSOC);

    }


    /*
     *
     *
     * Méthodes pour l'admin du site
     *
     *
     */

    // création de l'affichage de toutes les sections avec ses utilisateurs sur l'accueil de l'administration du site

    public function selectionnerCongeIndexAdmin(): array {
        $sql = "SELECT idconge, debut,
	GROUP_CONCAT(c.thename SEPARATOR '|||') AS thename, 
    GROUP_CONCAT(c.thesurname SEPARATOR '|||') AS thesurname
	FROM conge a
		LEFT JOIN thesection_has_thestudent b
			ON a.idthesection = b.thesection_idthesection
		LEFT JOIN thestudent c
			ON b.thestudent_idthestudent = c.idthestudent
    GROUP BY a.idthesection        
    ;";
        $recup = $this->db->query($sql);

        if($recup->rowCount()===0){
            return [];
        }
        return $recup->fetchAll(PDO::FETCH_ASSOC);

    }

    // Requête pour créer une section à partir d'une instance de type thesection

    public function createConge(conge $datas) {


        // vérification que les champs soient valides (pas vides)

        if(empty($datas->getDebut())||empty($datas->getFin())){
            return false;
        }

        $sql = "INSERT INTO conge (debut,fin) VALUES (?,?);";

        $insert = $this->db->prepare($sql);

        $insert->bindValue(1,$datas->getDebut(),PDO::PARAM_STR);
        $insert->bindValue(2,$datas->getFin(),PDO::PARAM_STR);


        // gestion des erreurs avec try catch
        try {
            $insert->execute();
            return true;

        }catch(PDOException $e){
            echo $e->getCode();
            return false;

        }

    }

    // Requête pour mettre à jour une section en vérifant si la variable get idsection correspond bien à la variable post idsection (usurpation d'identité)

    public function updateConge(conge $datas, int $get){

        // vérification que les champs soient valides (pas vides)
        if(empty($datas->getDebut())||empty($datas->getFin())||empty($datas->getIdthesection())){
            return false;
        }

        // vérification contre le contournement des droits
        if($datas->getIdconge()!=$get){
            return false;
        }

        $sql = "UPDATE conge SET debut=?, fin=? WHERE idconge=?";

        $update = $this->db->prepare($sql);

        $update->bindValue(1,$datas->getDebut(),PDO::PARAM_STR);
        $update->bindValue(2,$datas->getFin(),PDO::PARAM_STR);
        $update->bindValue(3,$datas->getIdconge(),PDO::PARAM_INT);

        try{
            $update->execute();
            return true;
        }catch (PDOException $e){
            echo $e->getCode();
            return false;
        }

    }

    // pour supprimer une section

    public function deleteConge(int $idconge){

        $sql = "DELETE FROM conge WHERE idconge=?";

        $delete = $this->db->prepare($sql);
        $delete->bindValue(1,$idconge, PDO::PARAM_INT);

        try{
            $delete->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getCode();
            return false;
        }

    }


}
