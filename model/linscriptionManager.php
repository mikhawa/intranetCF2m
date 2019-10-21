<?php

class linscriptionManager
{

    private $db;

    public function __construct(MyPDO $connect)
    {
        $this->db = $connect;
    }

public function displayContentLinscription(): array {
		$sql = "
		DESCRIBE
			linscription;";
		$sqlQuery = $this->db->prepare($sql);
		$sqlQuery->execute();
		
		return $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
	}
	
public function selectLinscription(int $id): array {
	$sql = "
	SELECT
		*
	FROM
		linscription
	WHERE
		idlinscription = :id;";
	$sqlQuery = $this->db->prepare($sql);
	$sqlQuery->bindParam(":id", $id, PDO::PARAM_INT);
	$sqlQuery->execute();
	
	return $sqlQuery->fetch(PDO::FETCH_ASSOC);
}

public function updateLinscription(int $id, array $datas) {
	$updateDatas = "";
	foreach($datas as $dataField => $data) {
		$updateDatas .= $dataField . " = '" . $data . "', ";
	}
	$updateDatas = substr($updateDatas, 0, -2);

	$sql = "
	UPDATE
		linscription
	SET
		" . $updateDatas . "
	WHERE
		idlinscription = :id;";
	$sqlQuery = $this->db->prepare($sql);
	$sqlQuery->bindParam(":id", $id, PDO::PARAM_INT);
	$sqlQuery->execute();
}

public function insertLinscription(array $datas): void {
	$sql = "
	INSERT INTO linscription(debut, fin, utilisateur_idutilisateur, lasession_idsession)
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

public function deleteLinscription(int $id): void {
	$sql = "
	DELETE
	FROM
		linscription
	WHERE
		idlinscription = :id;";
	$sqlQuery = $this->db->prepare($sql);
	$sqlQuery->bindParam(":id", $id, PDO::PARAM_INT);
	$sqlQuery->execute();
}

public function selectAllLinscription(): array {
	$sql = "
	SELECT
		*
	FROM
		linscription";
	$sqlQuery = $this->db->prepare($sql);
	$sqlQuery->execute();
	
	return $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
}
	
}