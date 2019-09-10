<?php


class linscription
{
protected $idlinscription;
protected $debut;
protected $fin;
protected $idutilisateur;
protected $idsession;


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
    public function getIdlinscription()
    {
        return htmlspecialchars_decode($this->idlinscription,ENT_QUOTES);
    }

    /**
     * @return mixed
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * @return mixed
     */
  public function getFin()
    {
        return $this->fin;
    }

     /**
     * @return mixed
     */
  public function getIdutilisateur()
  {
      return $this->idutilisateur;
  }

   /**
     * @return mixed
     */
    public function getdsession()
    {
        return $this->idsession;
    }

   

    /**
     * SETTERS
     */
    public function setIdlinscription( int $idlinscription)
    {
        if(!empty($idlinscription)){

            $this->idlinscription = $idlinscription;
        }
    }

    /**
     * @param mixed $lenomutilisateur
     */
    public function setDebut (string $debut)
    {
        $this->debut =htmlspecialchars(strip_tags(trim($debut)),ENT_QUOTES);
    }

    /**
     * @param mixed $lemotdepasse
     */
    public function setFin($fin)
    {
        $this->fin =htmlspecialchars(strip_tags(trim($fin)),ENT_QUOTES);
    }

     /**
     * @param mixed $lemotdepasse
     */
    public function setIdutilsateur($idutilisateur)
    {
        $this->idutilisateur =htmlspecialchars(strip_tags(trim($idutilisateur)),ENT_QUOTES);
    }


     /**
     * @param mixed $lemotdepasse
     */
    public function setIdsession($idsession)
    {
        $this->idsession =htmlspecialchars(strip_tags(trim($idsession)),ENT_QUOTES);
    }

   



}


