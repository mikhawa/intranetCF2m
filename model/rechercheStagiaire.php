<?php

class autoCompletion{


public static function rechercheUnStagiaire(){

    if (isset($_POST['param'])) {
        $demande = $_POST['param'];

$sql ='SELECT u.lenom, u.leprenom, s.lacronyme
		FROM lutilisateur u
		INNER JOIN linscription i
		ON i.utilisateur_idutilisateur = u.idlutilisateur
		INNER JOIN lasession s
		ON s.idlasession = i.lasession_idsession
		WHERE (u.lenom  
		LIKE "%'.$demande.'%") 
		OR (u.leprenom
		LIKE "%'.$demande.'%")
        ORDER BY s.lacronyme';
    
    }
    while ($row = mysqli_fetch_assoc($sql)){
        $resultset[] = $row["leprenom"]." ".$row["lenom"]." ".$row["lacronyme"];
    }
    
    if (!empty($resultset)) {
        $chaineretour = json_encode($resultset);
    } else {
        $chaineretour = json_encode("");
    }
    
}
}