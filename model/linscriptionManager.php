<?php
/**
 * Created by PhpStorm.
 * User: bogdan.rusu
 * Date: 01-07-19
 * Time: 15:13
 */

class linscriptionManager
{

    private $db;

    public function __construct(MyPDO $connect)
    {
        $this->db = $connect;
    }






     public function linscriptionDelete(int $id):void{
    $sql="DELETE FROM linscription WHERE idlinscription=?";
    $req = $this->db->prepare($sql);
    $req->bindValue(1,$id, PDO::PARAM_INT);
    $req->execute();



} public function linscriptionCreate(linscription $datas) {


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

    public function linscriptionSelectAll()
    {


        $sql = "SELECT lutilisateur.idlutilisateur,lutilisateur.lenom,lutilisateur.leprenom,lutilisateur.lemail,
 linscription.debut,linscription.fin,
 GROUP_CONCAT(lasession.lenom SEPARATOR '|||')AS nom_session,lasession.debut AS debut_session,lasession.fin AS fin_session,
 GROUP_CONCAT(lafiliere.lenom SEPARATOR '|||') AS lenom_filiere,lafiliere.lepicto,
 lerole.lintitule  AS lerole_Intitule,ledroit.lintitule AS droit
 FROM lutilisateur
 LEFT JOIN linscription ON lutilisateur.idlutilisateur=linscription.utilisateur_idutilisateur
 LEFT JOIN lasession ON linscription.lasession_idsession=lasession.idlasession
 LEFT JOIN lafiliere ON lasession.lafiliere_idfiliere=lafiliere.idlafiliere
 LEFT JOIN lutilisateur_has_lerole ON lutilisateur.idlutilisateur=lutilisateur_has_lerole.lutilisateur_idutilisateur
 LEFT JOIN lerole ON  lutilisateur_has_lerole.lerole_idlerole=lerole.idlerole
 LEFT JOIN lerole_has_ledroit ON lerole.idlerole=lerole_has_ledroit.lerole_idlerole
 LEFT JOIN ledroit ON  lerole_has_ledroit.ledroit_idledroit=ledroit.idledroit
 GROUP BY lutilisateur.idlutilisateur
 ORDER BY lutilisateur.idlutilisateur;";


        $recup = $this->db->query($sql);

        if ($recup->rowCount() === 0) {
            return [];
        }
        return $recup->fetchAll(PDO::FETCH_ASSOC);


    }

    }

