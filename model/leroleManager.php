<?php

class leroleManager
{
	
	private $db;
	
	public function __construct(MyPDO $connect) {
		$this->db = $connect;
    }
    
    public function connectLutilisateur(string $login, string $pwd): array {
		$sql = "
		SELECT
			lerole.lintitule AS intitule, lerole.ladescription AS description, lerole.idlerole AS role
		FROM
			lerole
		LEFT JOIN lutilisateur_has_lerole ON lerole_idlerole = idlerole
        LEFT JOIN lutilisateur ON idlutilisateur = lutilisateur_idutilisateur
		LIMIT 1;";
		$sqlQuery = $this->db->prepare($sql);
		$sqlQuery->execute();
		
		$result = $sqlQuery->fetch(PDO::FETCH_ASSOC);
		if($login == $result['login'] && password_verify((trim($pwd)), $result['pwd'])) {
			return [True, $result];
		} else {
			return [False, $result];
		}
	}
	
	public function displayContentLutilisateur(): array {
		$sql = "
		DESCRIBE
			lutilisateur;";
		$sqlQuery = $this->db->prepare($sql);
		$sqlQuery->execute();
		
		return $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function selectLutilisateur(int $id): array {
		$sql = "
		SELECT
			*
		FROM
			lerole
		WHERE
			idlutilisateur = :id;";
		$sqlQuery = $this->db->prepare($sql);
		$sqlQuery->bindParam(":id", $id, PDO::PARAM_INT);
		$sqlQuery->execute();
		
		return $sqlQuery->fetch(PDO::FETCH_ASSOC);
	}
	
	public function updateLutilisateur(int $id, array $datas) {
		$updateDatas = "";
		foreach($datas as $dataField => $data) {
			$updateDatas .= $dataField . " = '" . $data . "', ";
		}
		$updateDatas = substr($updateDatas, 0, -2);
	
		$sql = "
		UPDATE
			lerole
		SET
			" . $updateDatas . "
		WHERE
			idlerole = :id;";
		$sqlQuery = $this->db->prepare($sql);
		$sqlQuery->bindParam(":id", $id, PDO::PARAM_INT);
		$sqlQuery->execute();
    }
    
    public function createlerole(lerole $datas) {


        // vérification que les champs soient valides (pas vides)

        if(empty($datas->getLintitule())||empty($datas->getLadescription())){
            return false;
        }

        $sql = "INSERT INTO lerole (lintitutle,ladescription) VALUES (?,?);";

        $insert = $this->db->prepare($sql);

        $insert->bindValue(1,$datas->getLintitule(),PDO::PARAM_STR);
        $insert->bindValue(2,$datas->getLadescription(),PDO::PARAM_STR);


        // gestion des erreurs avec try catch
        try {
            $insert->execute();
            return true;

        }catch(PDOException $e){
            echo $e->getCode();
            return false;

        }

    }

	public function deleteLutilisateur(int $id): void {
		$sql = "
		DELETE
		FROM
			lerole
		WHERE
			idlerole = :id;";
		$sqlQuery = $this->db->prepare($sql);
		$sqlQuery->bindParam(":id", $id, PDO::PARAM_INT);
		$sqlQuery->execute();
	}

	
}