<?php


class leConge
{
protected $idleconge;
protected $debut;
protected $fin;
protected $letype;



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
    public function getIdleconge()
    {
        return htmlspecialchars_decode($this->idleconge,ENT_QUOTES);
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
  public function getLetype()
  {
      return $this->letype;
  }


  

    /**
     * SETTERS
     */
    public function setIdleconge(string $idconge)
    {
        if(!empty($idconge)){
            $this->idleconge = $idconge;
        }
    }

    /**
     * @param mixed $debut
     */
    public function setDebut (string $debut)
    {
        $this->debut =htmlspecialchars(strip_tags(trim($debut)),ENT_QUOTES);
    }

    /**
     * @param mixed $fin
     */
    public function setFin($fin)
    {
        $this->fin =htmlspecialchars(strip_tags(trim($fin)),ENT_QUOTES);
    }


    /**
     * @param mixed $letype
     */
    public function setLetype($letype)
    {
        $this->letype =htmlspecialchars(strip_tags(trim($letype)),ENT_QUOTES);
    }


}