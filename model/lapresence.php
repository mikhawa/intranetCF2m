<?php

class lapresence
{
	
protected $idlapresence;
protected $ampm;
protected $ladate;
protected $heuredebut;
protected $heurefin;
protected $lecode;
protected $linscription_idlinscription;

public function __construct(array $datas=[])
{
	if(empty($datas)){
		echo "Aucun array de données fourni";
	}else{
		$this->hydrate($datas);
	}
}

protected function hydrate(array $values){
	foreach($values AS $key => $value){
		$setterName = "set".ucfirst($key);
		if(method_exists($this, $setterName)){
			$this->$setterName($value);
		}
	}
}

public function getIdlapresence()
{
	return $this->idlapresence;
}

public function setIdlapresence(int $idlapresence = null): void
{
	if(!empty($idlapresence)) {
		$this->idlapresence = $idlapresence;
	}
}

public function getAmpm()
{
	return $this->ampm;
}

public function setAmpm(int $ampm = null): void
{
	if(!empty($ampm)) {
		$this->ampm = $ampm;
	}
}

public function getLadate()
{
	return $this->ladate;
}

public function setLadate(string $ladate = null): void
{
	if(!empty($ladate)) {
		$this->ladate = htmlspecialchars(strip_tags(trim($ladate)), ENT_QUOTES);
	}
}

public function getHeuredebut()
{
	return $this->heuredebut;
}

public function setHeuredebut(string $heuredebut = null): void
{
	if(!empty($heuredebut)) {
		$this->heuredebut = htmlspecialchars(strip_tags(trim($heuredebut)), ENT_QUOTES);
	}
}

public function getHeurefin()
{
	return $this->heurefin;
}

public function setHeurefin(string $heurefin = null): void
{
	if(!empty($heurefin)) {
		$this->heurefin = htmlspecialchars(strip_tags(trim($heurefin)), ENT_QUOTES);
	}
}

public function getLecode()
{
	return $this->lecode;
}

public function setLecode(string $lecode = null): void
{
	if(!empty($lecode)) {
		$this->lecode = htmlspecialchars(strip_tags(trim($lecode)), ENT_QUOTES);
	}
}

public function getLinscription_idlinscription()
{
	return $this->linscription_idlinscription;
}

public function setLinscription_idlinscription(int $linscription_idlinscription = null): void
{
	if(!empty($linscription_idlinscription)) {
		$this->linscription_idlinscription = $linscription_idlinscription;
	}
}
	
}