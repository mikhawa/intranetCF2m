<?php



class sessionManager
{



    private $db;

    public function __construct(MyPDO $connect)
    {

        $this->db = $connect;
    }

    public function sessionSelectALL():array{

        $sql = "SELECT * FROM lasession ORDER BY lenom ASC;";
        $recup = $this->db->query($sql);
        if ($recup->rowCount() === 0) {
            return [];
        }
        return $recup->fetchAll(PDO::FETCH_ASSOC);
       }

   

   public function sessionSelectByID(int $idlasession): array {

      if (empty($idlasession))
      
      {   
                  
        return[];

      }
    
    
    $sql="SELECT idlasession FROM lasession where idlasession=?;";
    $recup = $this->db->prepare($sql);
    $recup->bindValue(1, $idlasession, PDO::PARAM_INT);
    $recup->execute();


    if ($recup->rowCount() === 0) {
        return [];
    }
    return $recup->fetch(PDO::FETCH_ASSOC);
  }


public function  sessionCreate( lasession $lasession) {

    if(empty($lasession->getLenom())||empty($lasession->getLacronyme())||empty($lasession->getLanne())||empty($lasession->getLenumero())||empty($lasession->getLetype())||empty($lasession->getDebut())||empty($lasession->getFin())){
       return false;

    }


    $sql="INSERT INTO  thesession (lenom,lacronyme,lanne,lenumero,letype,debut,fin) VALUE(?,?);";

    $insert= $this->db->prepare($sql);
    $insert->bindValue(1,$lasession->getLenom(),PDO::PARAM_STR);
    $insert->bindValue(2, $lasession->getLacronyme(), PDO::PARAM_STR);
    $insert->bindValue(3, $lasession->getLanne(), PDO::PARAM_STR);
    $insert->bindValue(4, $lasession->getLenumero(), PDO::PARAM_STR);
    $insert->bindValue(5, $lasession->getLetype(), PDO::PARAM_STR);
    $insert->bindValue(6, $lasession->getDebut(), PDO::PARAM_STR);
    $insert->bindValue(7, $lasession->getFin(), PDO::PARAM_STR);
   
   try{
       
    $insert->execute();
    return true;

   } catch(PDOException $a){
        echo $a->getCode();
        return false;
        
   }




   
    
    } 




    public function sessionUpdate(lasession $lasession, int $get){


        if (empty($lasession->getLenom()) || empty($lasession->getLacronyme()) || empty($lasession->getLanne()) || empty($lasession->getLenumero()) || empty($lasession->getLetype()) || empty($lasession->getDebut()) || empty($lasession->getFin())|| empty($lasession->getIdlasession())) {
            return false;
    }

        if ($datas->getIdthesection() != $get){ 
            return false;
        }
         $sql ="UPDATE lasession SET lenom=?, lacronyme=?, lanne=?, lenumero=?,letype=?, debut=?, fin=? WHERE idlasession=?";


        $update = $this->db->prepare($sql);
        $update->bindValue(1, $lasession->getLenom(), PDO::PARAM_STR);
        $update->bindValue(2, $lasession->getLacronyme(), PDO::PARAM_STR);
        $update->bindValue(3, $lasession->getLanne(), PDO::PARAM_STR);
        $update->bindValue(4, $lasession->getLenumero(), PDO::PARAM_STR);
        $update->bindValue(5, $lasession->getLetype(), PDO::PARAM_STR);
        $update->bindValue(6, $lasession->getDebut(), PDO::PARAM_STR);
        $update->bindValue(7, $lasession->getFin(), PDO::PARAM_STR);
        $update->bindValue(8,$lasession->getIdlasession(),PDO::PARAM_INT);

        try{

            $update->execute();
            return true;

         } catch(PDOException $e){

             echo $e->getCode();
              return false;

         }
   
}


public function sessionDelete(int $idlasession){

   $sql="DELETE FROM lasession WHERE idlasession=?";

$delete =$this->db->prepare($sql);
$delete->bindValue(1,$idlasession,PDO:: PARAM_INT); 

try{
   $delete->execute();
     return true;

}catch(PDOException $e){
    echo $e->getCode();

     return false;

}


}






}

 




   



