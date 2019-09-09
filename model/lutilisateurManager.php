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
			return ['True', $result];
		} else {
			return ['False', $result];
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

}