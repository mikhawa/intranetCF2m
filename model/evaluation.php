<?php

class evaluation
{
protected $idlutilisateur;
protected $lenomutilisateur;
protected $lenom;
protected $leprenom;
protected $lemail;


//méthodes

public function __construct (array $data = [])
{
    if(!empty($data)){       
        $this->hydrate($data);
    }
}

protected function hydrate (array $tablehydrate ){
    foreach ($tablehydrate AS $key=>$value){
        $setterName = "set".ucfirst($key);
        if(method_exists($this,$setterName)){
            $this->$setterName($value);
        }
    }
}

    /**
     * GETTERS
     */
    public function getIdlutilisateur()
    {
        return htmlspecialchars_decode($this->idlutilisateur,ENT_QUOTES);
    }

    /**
     * @return mixed
     */
    public function getLenomutilisateur()
    {
        return $this->lenomutilisateur;
    }

    /**
     * @return mixed
     */
  public function getLenom()
    {
        return $this->lenom;
    }

     /**
     * @return mixed
     */
  public function getLeprenom()
  {
      return $this->leprenom;
  }

   /**
     * @return mixed
     */
    public function getLemail()
    {
        return $this->lemail;
    }



   

    /**
     * SETTERS
     */
    public function setIdlutilisateur( int $idlutilisateur)
    {
        if(!empty($idlutilisateur)){

            $this->idlutilisateur = $idlutilisateur;
        }
    }

    /**
     * @param mixed $lenom
     */
    public function setLenomutilisateur (string $lenomutilisateur)
    {
        $this->lenomutilisateur =htmlspecialchars(strip_tags(trim($lenomutilisateur)),ENT_QUOTES);
    }

    /**
     * @param mixed $lenom
     */
    public function setLenom($lenom)
    {
        $this->lenom =htmlspecialchars(strip_tags(trim($lenom)),ENT_QUOTES);
    }

     /**
     * @param mixed $leprenom
     */
    public function setLeprenom($leprenom)
    {
        $this->leprenom =htmlspecialchars(strip_tags(trim($leprenom)),ENT_QUOTES);
    }


     /**
     * @param mixed $lemail
     */
    public function setLemail($lemail)
    {
        $this->lemail =htmlspecialchars(strip_tags(trim($lemail)),ENT_QUOTES);
    }

    

   



}
