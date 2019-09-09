<?php

class lutilisateurManager
{
	
	private $db;
	
	public function __construct(MyPDO $connect) {
		$this->db = $connect;
	}
	
	public function connectLutilisateur(string $login, string $pwd): array {
		$sql = "
		SELECT
			lutilisateur.lenomutilisateur AS login, lutilisateur.lemotdepasse AS pwd, lerole.idlerole AS role
		FROM
			lutilisateur
		LEFT JOIN lutilisateur_has_lerole ON lutilisateur.idlutilisateur = lerole_idlerole
		LEFT JOIN lerole ON lerole.idlerole = lutilisateur_idutilisateur
		WHERE lutilisateur.lenomutilisateur = '" . $login . "'" . "
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
			lutilisateur
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
			lutilisateur
		SET
			" . $updateDatas . "
		WHERE
			idlutilisateur = :id;";
		$sqlQuery = $this->db->prepare($sql);
		$sqlQuery->bindParam(":id", $id, PDO::PARAM_INT);
		$sqlQuery->execute();
	}

	public function deleteLutilisateur(int $id): void {
		$sql = "
		DELETE
		FROM
			lutilisateur
		WHERE
			idlutilisateur = :id;";
		$sqlQuery = $this->db->prepare($sql);
		$sqlQuery->bindParam(":id", $id, PDO::PARAM_INT);
		$sqlQuery->execute();
	}
	
	public function deleteLutilisateur(int $id): void {
		global $PDOConnect;
	
		$sql = "
		DELETE
		FROM
			lutilisateur
		WHERE
			idlutilisateur = :id;";
		$sqlQuery = $this->db->prepare($sql);
		$sqlQuery->bindParam(":id", $id, PDO::PARAM_INT);
		$sqlQuery->execute();
	}
	
	public function selectAllLutilisateur(): array {
		global $PDOConnect;
	
		$sql = "
		SELECT
			*
		FROM
			lutilisateur";
		$sqlQuery = $this->db->prepare($sql);
		$sqlQuery->execute();
		
		return $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function selectLutilisateurJoinLerole(string $joinType = "inner"): array {
		global $PDOConnect;
		$joinType = strtolower($joinType);
		if($joinType !== "inner" && $joinType !== "left" && $joinType !== "right") {return [];}
	
		$sql = "
		SELECT
			lutilisateur.idlutilisateur AS lutilisateur_idlutilisateur, lutilisateur.lenomutilisateur AS lutilisateur_lenomutilisateur, lutilisateur.lemotdepasse AS lutilisateur_lemotdepasse, lutilisateur.lenom AS lutilisateur_lenom, lutilisateur.leprenom AS lutilisateur_leprenom, lutilisateur.lemail AS lutilisateur_lemail, lutilisateur.luniqueid AS lutilisateur_luniqueid, lutilisateur_has_lerole.lutilisateur_idutilisateur AS lutilisateur_has_lerole_lutilisateur_idutilisateur, lutilisateur_has_lerole.lerole_idlerole AS lutilisateur_has_lerole_lerole_idlerole, lerole.idlerole AS lerole_idlerole, lerole.lintitule AS lerole_lintitule, lerole.ladescription AS lerole_ladescription
		FROM
			lutilisateur
		" . $joinType . " JOIN lutilisateur_has_lerole ON lutilisateur.idlutilisateur = lerole_idlerole
		" . $joinType . " JOIN lerole ON lerole.idlerole = lutilisateur_idutilisateur;";
		$sqlQuery = $this->db->prepare($sql);
		$sqlQuery->execute();
		
		return $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
	}

}