<?php
class lutilisateurManager {
    private $db;
    public function __construct(MyPDO $connect) {
        $this->db = $connect;
    }
    /*
     * Connexion
     */
    public function connectLutilisateur(lutilisateur $user): bool {
        /*
         * Query to take an user
         */
        $sql = "SELECT lutilisateur.idlutilisateur, lutilisateur.lenomutilisateur, lutilisateur.lenom, lutilisateur.lemotdepasse AS pwd ,lutilisateur.leprenom, lutilisateur.lemail, lutilisateur.luniqueid, 
            lerole.idlerole, lerole.lintitule, lerole.ladescription
		FROM 
                    lutilisateur
		LEFT JOIN 
                    lutilisateur_has_lerole ON lutilisateur.idlutilisateur = lutilisateur_has_lerole.lutilisateur_idutilisateur
		LEFT JOIN 
                    lerole ON lerole.idlerole = lutilisateur_has_lerole.lerole_idlerole
		WHERE lutilisateur.lenomutilisateur = :lenomutilisateur 
		LIMIT 1;"; // LIMIT 1 tant qu'un utilisateur ne peut avoir qu'un rôle (many to one artificiel, car la db permet le many to many)
        // on récupère l'utilisateur si valide par le champs "lenomutilisateur" sans vérifier le mot de passe
        $sqlQuery = $this->db->prepare($sql);
        $sqlQuery->bindValue(":lenomutilisateur", $user->getLenomutilisateur(), PDO::PARAM_STR);
        $sqlQuery->execute();
        $result = $sqlQuery->fetch(PDO::FETCH_ASSOC);
        // si le mot de passe est valide, on vérifie le mot de passe crypté avec password_hash(mot_de_passe, PASSWORD_DEFAULT), soit décrypté et valide avec la fonction password_verify(mdp_formulaire, mdp_db))
        if ($user->getLenomutilisateur() == $result['lenomutilisateur'] && password_verify($user->getLemotdepasse(), $result['pwd'])) {
            // si ok création de la session qui contient tous les champs des 2 tables sélectionnées lors de la connexion, + la session_id, - pwd qu'on ne souhaite pas garder dans e mdp dans la session, utilisation de unset qui détruit la variable $_SESSION['pwd']
            $_SESSION = $result;
            $_SESSION['TheIdSess'] = session_id();
            unset($_SESSION['pwd']);
            return True;
        } else {
            return False;
        }
    }
    public function lutilisateurDisplayContent(): array {
        $sql = "DESCRIBE lutilisateur;";
        $sqlQuery = $this->db->prepare($sql);
        $sqlQuery->execute();
        return $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
    }
    public function lutilisateurSelectById(lutilisateur $user): array {
        $sql = "
		SELECT
			*
		FROM
			lutilisateur
		WHERE
			idlutilisateur = :id;";
        $sqlQuery = $this->db->prepare($sql);
        $sqlQuery->bindValue(":id", $user->getIdutilisateur(), PDO::PARAM_INT);
        $sqlQuery->execute();
        return $sqlQuery->fetch(PDO::FETCH_ASSOC);
    }
    public function lutilisateurUpdate(lutilisateur $user, array $datas) {
        $updateDatas = "";
        foreach ($datas as $dataField => $data) {
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
        $sqlQuery->bindValue(":id", $user->getIdutilisateur(), PDO::PARAM_INT);
        $sqlQuery->execute();
    }
    public function lutilisateurDelete(lutilisateur $user): void {
        $sql = "
		DELETE
		FROM
			lutilisateur
		WHERE
			idlutilisateur = :id;";
        $sqlQuery = $this->db->prepare($sql);
        $sqlQuery->bindValue(":id", $user->getIdutilisateur(), PDO::PARAM_INT);
        $sqlQuery->execute();
    }
    public function lutilisateurSelectAll(): array {
        $sql = "
		SELECT
			*
		FROM
			lutilisateur";
        $sqlQuery = $this->db->prepare($sql);
        $sqlQuery->execute();
        return $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
    }
    public function lutilisateurSelectAllJoinLerole(string $joinType = "inner"): array {
        $joinType = strtolower($joinType);
        if ($joinType !== "inner" && $joinType !== "left" && $joinType !== "right") {
            return [];
        }
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
    //create a new user
    public function lutilisateurCreate( lutilisateur $user) {
        if( empty($user->getIdlutilisateur()) ||empty($user->getLenomutilisateur()) ||empty($user->getLemotdepasse()) ||empty($user->getLenom()) ||empty($user->getLeprenom()) ||empty($user->getLemail()) ||empty($user->getLuniqueid())){
          return false;
    }

    $sql = "INSERT INTO lutilisateur (idlutilisateur, lenomutilisateur, lemotdepasse, lenom, leprenom, lemail, luniqueid) VALUE(?,?,?,?,?,?,?);";
    $insert = $this->db->prepare($sql);
    $insert->bindvalue(1, $user->getIdlutilisateur(),PDO::PARAM_STR);
    $insert->bindvalue(2, $user->getLenomutilisateur(),PDO::PARAM_STR);
    $insert->bindvalue(3, $user->getLemotdepasse(),PDO::PARAM_STR);
    $insert->bindvalue(4, $user->getLenom(),PDO::PARAM_STR);
    $insert->bindvalue(5, $user->getLeprenom(),PDO::PARAM_STR);
    $insert->bindvalue(6, $user->getLemail(),PDO::PARAM_STR);
    $insert->bindvalue(7, $user->getLuniqueid(),PDO::PARAM_STR);
    //gestion des erreurs avec try catch
    try{
        $insert->execute();
        return true;
    }catch(PDOException $e){
        echo $e->getCode();
        return false;
    }


	if(!$emailExists) {
		$sql = "INSERT INTO lutilisateur (idlutilisateur, lenomutilisateur, lemotdepasse, lenom, leprenom, lemail, luniqueid) VALUE(?,?,?,?,?,?,?);";

		$insert = $this->db->prepare($sql);

		$insert->bindvalue(1, $user->getIdlutilisateur(),PDO::PARAM_STR);
		$insert->bindvalue(2, $user->getLenomutilisateur(),PDO::PARAM_STR);
		$insert->bindvalue(3, $user->getLemotdepasse(),PDO::PARAM_STR);
		$insert->bindvalue(4, $user->getLenom(),PDO::PARAM_STR);
		$insert->bindvalue(5, $user->getLeprenom(),PDO::PARAM_STR);
		$insert->bindvalue(6, $user->getLemail(),PDO::PARAM_STR);
		$insert->bindvalue(7, $user->getLuniqueid(),PDO::PARAM_STR);

		//gestion des erreurs avec try catch

		try{
			$insert->execute();
			return true;
		}catch(PDOException $e){
			echo $e->getCode();
			return false;
		}
	} else {
		return false;
	}

	}

    // methode de deconnexion
    public function disconnectLutilisateur() {
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
        header("Location: ./");
    }
  
    public function motDePasseOublier(lutilisateur $user){


        $sql="UPDATE lutilisateur SET lemotdepasse = ?  WHERE idlutilisateur = ?;";
        $insert = $this->db->prepare($sql);

        $insert->bindvalue(1, $user->getLemotdepasse(),PDO::PARAM_STR);
        $insert->bindvalue(2, $user->getIdutilisateur(),PDO::PARAM_STR);

        try{
            $insert->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getCode();
            return false;
        }

    }
    public function checkMail( string $mail){
        $sql ="SELECT * FROM lutilisateur WHERE lemail = ? ";
        $result = $this->db->prepare($sql);

        $result->bindvalue(1, $mail,PDO::PARAM_STR);

        //gestion des erreurs avec try catch

        try{
            $result->execute();
            return $result->rowCount()==1 ? true : false;



        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }

    }

}
