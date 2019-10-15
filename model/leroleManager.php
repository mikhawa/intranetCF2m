<?php


class leroleManager

{
	
	private $db;
	
	public function __construct(MyPDO $connect) {
		$this->db = $connect;
    }
    
    public function displayContentLerole(): array {
		$sql = "
		DESCRIBE
			lerole;";
		$sqlQuery = $this->db->prepare($sql);
		$sqlQuery->execute();
		
		return $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function selectLerole(int $id): array {
		$sql = "
		SELECT
			*
		FROM
			lerole
		WHERE
			idlerole = :id;";
		$sqlQuery = $this->db->prepare($sql);
		$sqlQuery->bindParam(":id", $id, PDO::PARAM_INT);
		$sqlQuery->execute();
		
		return $sqlQuery->fetch(PDO::FETCH_ASSOC);
	}
	
	public function updateLerole(int $id, array $datas) {
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
	
	public function insertLerole(array $datas): void {
		$sql = "
		INSERT INTO lerole(lintitule, ladescription)
		VALUES
			(";
		foreach($datas as $data) {
			$sql .= (gettype($data) == "string" ? "'" . $data . "'" : $data) . ", ";
		}
		$sql = substr($sql, 0, -2);
		$sql .= ");";
		$sqlQuery = $this->db->prepare($sql);
		$sqlQuery->execute();
	}

	public function deleteLerole(int $id): void {
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
	
	public function selectAllLerole(): array {
		$sql = "
		SELECT
			*
		FROM
			lerole
		";
		$sqlQuery = $this->db->prepare($sql);
		$sqlQuery->execute();
		
		return $sqlQuery->fetchAll(PDO::FETCH_ASSOC);

	}
	
	public function selectLeroleJoinLedroit(string $joinType = "inner"): array {
		$joinType = strtolower($joinType);
		if($joinType !== "inner" && $joinType !== "left" && $joinType !== "right") {return [];}
	
		$sql = "
		SELECT
			lerole.idlerole AS lerole_idlerole, lerole.lintitule AS lerole_lintitule, lerole.ladescription AS lerole_ladescription, lerole_has_ledroit.lerole_idlerole AS lerole_has_ledroit_lerole_idlerole, lerole_has_ledroit.ledroit_idledroit AS lerole_has_ledroit_ledroit_idledroit, ledroit.idledroit AS ledroit_idledroit, ledroit.lintitule AS ledroit_lintitule, ledroit.ladescription AS ledroit_ladescription
		FROM
			lerole
		" . $joinType . " JOIN lerole_has_ledroit ON lerole.idlerole = lerole_idlerole
		" . $joinType . " JOIN ledroit ON ledroit.idledroit = ledroit_idledroit;";
		$sqlQuery = $this->db->prepare($sql);
		$sqlQuery->execute();
		
		return $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectLeroleJoinLutilisateur(string $joinType = "inner"): array {
		$joinType = strtolower($joinType);
		if($joinType !== "inner" && $joinType !== "left" && $joinType !== "right") {return [];}
	
		$sql = "
		SELECT
			lerole.idlerole AS lerole_idlerole, lerole.lintitule AS lerole_lintitule, lerole.ladescription AS lerole_ladescription, lutilisateur_has_lerole.lutilisateur_idutilisateur AS lutilisateur_has_lerole_lutilisateur_idutilisateur, lutilisateur_has_lerole.lerole_idlerole AS lutilisateur_has_lerole_lerole_idlerole, lutilisateur.idlutilisateur AS lutilisateur_idlutilisateur, lutilisateur.lenomutilisateur AS lutilisateur_lenomutilisateur, lutilisateur.lemotdepasse AS lutilisateur_lemotdepasse, lutilisateur.lenom AS lutilisateur_lenom, lutilisateur.leprenom AS lutilisateur_leprenom, lutilisateur.lemail AS lutilisateur_lemail, lutilisateur.luniqueid AS lutilisateur_luniqueid
		FROM
			lerole
		" . $joinType . " JOIN lutilisateur_has_lerole ON lerole.idlerole = lerole_idlerole
		" . $joinType . " JOIN lutilisateur ON lutilisateur.idlutilisateur = lutilisateur_idutilisateur;";
		$sqlQuery = $this->db->prepare($sql);
		$sqlQuery->execute();
		
		return $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
	}


	
}