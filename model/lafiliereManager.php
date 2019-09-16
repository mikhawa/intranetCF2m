<?php

class lafiliereManager
{
	
	private $db;

	public function __construct(MyPDO $connect)
	{
		 $this->db=$connect;       
	}
	
	public function displayContentLafiliere(): array {
		$sql = "
		DESCRIBE
			lafiliere;";
		$sqlQuery = $this->db->prepare($sql);
		$sqlQuery->execute();
		
		return $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function selectLafiliere(int $id): array {
		$sql = "
		SELECT
			*
		FROM
			lafiliere
		WHERE
			idlafiliere = :id;";
		$sqlQuery = $this->db->prepare($sql);
		$sqlQuery->bindParam(":id", $id, PDO::PARAM_INT);
		$sqlQuery->execute();
		
		return $sqlQuery->fetch(PDO::FETCH_ASSOC);
	}
	
	public function updateLafiliere(int $id, array $datas) {
		$updateDatas = "";
		foreach($datas as $dataField => $data) {
			$updateDatas .= $dataField . " = '" . $data . "', ";
		}
		$updateDatas = substr($updateDatas, 0, -2);
	
		$sql = "
		UPDATE
			lafiliere
		SET
			" . $updateDatas . "
		WHERE
			idlafiliere = :id;";
		$sqlQuery = $this->db->prepare($sql);
		$sqlQuery->bindParam(":id", $id, PDO::PARAM_INT);
		$sqlQuery->execute();
	}
	
	public function insertLafiliere(array $datas): void {
		$sql = "
		INSERT INTO lafiliere(lenom, lacronyme, lacouleur, lepicto)
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

	public function deleteLafiliere(int $id): void {
		$sql = "
		DELETE
		FROM
			lafiliere
		WHERE
			idlafiliere = :id;";
		$sqlQuery = $this->db->prepare($sql);
		$sqlQuery->bindParam(":id", $id, PDO::PARAM_INT);
		$sqlQuery->execute();
	}
	
	public function selectAllLafiliere(): array {
		$sql = "
		SELECT
			*
		FROM
			lafiliere";
		$sqlQuery = $this->db->prepare($sql);
		$sqlQuery->execute();
		
		return $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
	}
	
}