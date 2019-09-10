<?php


class linscription
{
    protected $idlinscription;
    protected $debut;
    protected $fin;
    protected $utilisateur_idutilisateur;
    protected $lasession_idsession;

//méthodes

    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    protected function hydrate(array $tablehydrate)
    {
        foreach ($tablehydrate AS $key => $value) {
            $setterName = "set" . ucfirst($key);
            if (method_exists($this, $setterName)) {
                $this->$setterName($value);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getIdlinscription()
    {
        return $this->idlinscription;
    }

    /**
     * @param mixed $idlinscription
     */
    public function setIdlinscription($idlinscription): void
    {
        $this->idlinscription = $idlinscription;
    }

    /**
     * @return mixed
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * @param mixed $debut
     */
    public function setDebut($debut): void
    {
        $this->debut = $debut;
    }

    /**
     * @return mixed
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * @param mixed $fin
     */
    public function setFin($fin): void
    {
        $this->fin = $fin;
    }

    /**
     * @return mixed
     */
    public function getUtilisateurIdutilisateur()
    {
        return $this->utilisateur_idutilisateur;
    }

    /**
     * @param mixed $utilisateur_idutilisateur
     */
    public function setUtilisateurIdutilisateur($utilisateur_idutilisateur): void
    {
        $this->utilisateur_idutilisateur = $utilisateur_idutilisateur;
    }

    /**
     * @return mixed
     */
    public function getLasessionIdsession()
    {
        return $this->lasession_idsession;
    }

    /**
     * @param mixed $lasession_idsession
     */
    public function setLasessionIdsession($lasession_idsession): void
    {
        $this->lasession_idsession = $lasession_idsession;
    }


}