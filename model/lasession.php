<?php



class  lasession
{



    protected $idlasession;
    protected $lenom;
    protected $lacronyme;
    protected $lannee;
    protected $lenumero;
    protected $letype;
    protected $debut;
    protected $fin;
    protected $lafiliere_idfiliere;

    public function __construct(array $donnee = [])
    {

        if (!empty($donnee)) {
            $this->hydrate($donnee);
        }
    }

    protected function hydrate(array $values)
    {
        foreach ($values as $key => $value) {
            $setterName = "set" . ucfirst($key);
            if (method_exists($this, $setterName)) {
                $this->$setterName($value);
            }
        }
    }



    public function getIdlasession()
    {
        return $this->idlasession;
    }
    public function setIdlasession(int $idlasession)
    {
        $this->idlasession = $idlasession;
    }


    public function getLenom()
    {
        return $this->lenom;
    }
    public function setLenom($lenom)
    {
        $this->lenom = htmlspecialchars(strip_tags(trim($lenom)), ENT_QUOTES);
    }


    public function getLacronyme()
    {
        return $this->lacronyme;
    }
    public function setLacronyme($lacronyme)
    {
        $this->lacronyme = htmlspecialchars(strip_tags(trim($lacronyme)), ENT_QUOTES);
    }


    public function getLannee()
    {
        return $this->lannee;
    }
    public function setLannee(int $lannee)
    {
        $this->lannee = $lannee;
    }


    public function getLenumero()
    {
        return $this->lenumero;
    }
    public function setLenumero(int $lenumero)
    {
        $this->lenumero = $lenumero;
    }


    public function getLetype()
    {
        return $this->letype;
    }
    public function setLetype(int $letype)
    {
        $this->letype = $letype;
    }


    public function getDebut()
    {
        return $this->debut;
    }
    public function setDebut($debut)
    {
        $this->debut = htmlspecialchars(strip_tags(trim($debut)), ENT_QUOTES);
    }


    public function getFin()
    {
        return $this->fin;
    }
    public function setFin($fin)
    {
        $this->fin = htmlspecialchars(strip_tags(trim($fin)), ENT_QUOTES);
    }


    public function getLafiliere_idfiliere()
    {
        return $this->lafiliere_idfiliere;
    }
    public function setLafiliere_idfiliere(int $lafiliere_idfiliere)
    {
        $this->lafiliere_idfiliere = $lafiliere_idfiliere;
    }
}
