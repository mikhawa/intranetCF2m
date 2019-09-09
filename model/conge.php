<?php


class lerole
{
protected $idconge;
protected $debut;
protected $fin;



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
    public function getIdconge()
    {
        return htmlspecialchars_decode($this->idconge,ENT_QUOTES);
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
     * SETTERS
     */
    public function setIdconge( int $idconge)
    {
        if(!empty($idconge)){

            $this->idconge = $idconge;
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

     


}