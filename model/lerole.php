<?php

class lerole
{
    protected $idlerole;
    protected $lintitule;
    protected $ladescription;
    protected $actif = 1;

//méthodes

    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    protected function hydrate(array $tablehydrate)
    {
        foreach ($tablehydrate as $key => $value) {
            $setterName = "set" . ucfirst($key);
            if (method_exists($this, $setterName)) {
                $this->$setterName($value);
            }
        }
    }

    /**
     * GETTERS
     */
    public function getIdlerole()
    {
        return htmlspecialchars_decode($this->idlerole, ENT_QUOTES);
    }

    /**
     * @return mixed
     */
    public function getLintitule()
    {
        return htmlspecialchars_decode($this->lintitule, ENT_QUOTES);
    }

    public function getLadescription()
    {
        return htmlspecialchars_decode($this->ladescription, ENT_QUOTES);
    }

    public function getActif()
    {
        return $this->actif;
    }

    /**
     * SETTERS
     */
    public function setIdlerole(int $idlerole)
    {
        if (!empty($idlerole)) {

            $this->idlerole = $idlerole;
        }
    }

    /**
     * @param mixed $lenomutilisateur
     */
    public function setLintitule(string $lintitule)
    {
        $this->lintitule = htmlspecialchars(strip_tags(trim($lintitule)), ENT_QUOTES);
    }

    /**
     * @param mixed $lemotdepasse
     */
    public function setLadescription($ladescription)
    {
        $this->ladescription = htmlspecialchars(strip_tags(trim($ladescription)), ENT_QUOTES);
    }

    /**
     * @param mixed $actif
     */
    public function setActif(int $actif)
    {
        $this->actif = $actif;
    }

}
