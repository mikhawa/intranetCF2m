<?php

class evaluationManager {
    private $db;
    public function __construct(MyPDO $connect) {
        $this->db = $connect;
    }


    //selection de tous les stagiaires

    public function selectAllStagiairesForEval(){

        $sql = "SELECT u.lenom, u.leprenom
		FROM lutilisateur u
		INNER JOIN linscription i
		ON i.utilisateur_idutilisateur = u.idlutilisateur
		INNER JOIN lasession s
        ON s.idlasession = i.lasession_idsession;";
        
        $recup = $this->db->query($sql);
        if ($recup->rowCount() === 0) {
            return [];
        }
        return $recup->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectAllFiliereForEval(): array{

        $sql="SELECT lenom, idlafiliere
              FROM lafiliere";

        $recup = $this->db->query($sql);
        if ($recup->rowCount() === 0) {
            return [];
        }
        return $recup->fetchAll(PDO::FETCH_ASSOC);  

    }








}