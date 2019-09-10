<?php





class lafiliereManager{

   private $db;

   public function __construct(MyPDO $connect)
   {
         $this->db=$connect;       
   }


}
