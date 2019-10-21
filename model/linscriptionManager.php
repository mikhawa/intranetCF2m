<?php

class linscriptionManager
{

    private $db;

    public function __construct(MyPDO $connect)
    {
        $this->db = $connect;
    }

<<<<<<< HEAD
public static function displayContentLinscription(): array {
=======

public function displayContentLinscription(): array {
>>>>>>> 0571874b5782e9b88f653f712637d704fe4f9e1b
		$sql = "
		DESCRIBE
			linscription;";
		$sqlQuery = $this->db->prepare($sql);
		$sqlQuery->execute();
		
		return $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
	}
	
<<<<<<< HEAD
public static function selectLinscription(int $id): array {
=======
public function selectLinscription(int $id): array {
>>>>>>> 0571874b5782e9b88f653f712637d704fe4f9e1b
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

<<<<<<< HEAD
public static function updateLinscription(int $id, array $datas) {
=======




     public function linscriptionDelete(int $id):void{
    $sql="DELETE FROM linscription WHERE idlinscription=?";
    $req = $this->db->prepare($sql);
    $req->bindValue(1,$id, PDO::PARAM_INT);
    $req->execute();



} 
public function linscriptionCreate(linscription $datas) {


    // vérification que les champs soient valides (pas vides)

    if(empty($datas->getDebut()||empty($datas->getFin()||empty($datas->getUtilisateurIdutilisateur()||empty($datas->getLasessionIdsession()))))){
        return false;
    }

    $sql = "INSERT INTO linscription (debut, fin, utilisateur_idutilisateur,lasession_idsession) VALUES(?,?,?,?);";

    $insert = $this->db->prepare($sql);


    $insert->bindValue(1,$datas->getDebut(),PDO::PARAM_STR);
    $insert->bindValue(2,$datas->getFin(),PDO::PARAM_STR);
    $insert->bindValue(3,$datas->getUtilisateurIdutilisateur(),PDO::PARAM_STR);
    $insert->bindValue(4,$datas->getLasessionIdsession(),PDO::PARAM_STR);



    // gestion des erreurs avec try catch
    try {
        $insert->execute();
        return true;

    }catch(PDOException $e){
        echo $e->getCode();
        return false;

    }


}

public function updateLinscription(int $id, array $datas) {
>>>>>>> 0571874b5782e9b88f653f712637d704fe4f9e1b
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

<<<<<<< HEAD
public static function insertLinscription(array $datas): void {
=======
public function insertLinscription(array $datas): void {
>>>>>>> 0571874b5782e9b88f653f712637d704fe4f9e1b
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

<<<<<<< HEAD
public static function deleteLinscription(int $id): void {
=======
public function deleteLinscription(int $id): void {
>>>>>>> 0571874b5782e9b88f653f712637d704fe4f9e1b
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

<<<<<<< HEAD
public static function selectAllLinscription(): array {
=======
public function selectAllLinscription(): array {
>>>>>>> 0571874b5782e9b88f653f712637d704fe4f9e1b
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