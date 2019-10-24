<?php

if(isset($_GET['viewdetailsession'])) {

    $selectEval = $evaluationM->selectAllFiliereForEval();


     echo $twig->render("view_stagiaires/choix_filiere.html.twig", ['lutilisateur'=>$selectEval]);




}elseif(isset($_GET['choixFiliere'])){

    $nomStagiaire = $evaluationM->selectAllStagiairesForEval();

    echo $twig->render("view_stagiaires/choix_stagiaire.html.twig",['lutilisateur'=>$nomStagiaire]);

} elseif (isset($_GET['viewlafiliere'])) {
	
	$paginFiliere = isset($_GET['pgFiliere']) ? (int)$_GET['pgFiliere'] : 1;
	
    $nbFiliere = $lafiliereM->selectFiliereCountById();
	
    $nbPageFiliere = $lafiliereM->selectFiliereWithLimitPublic($paginFiliere, 5);
	
    $PaginationFiliere = pagination::pagine($nbFiliere, 5, $paginFiliere, "viewlafiliere&pgFiliere");
	
    echo $twig->render('lafiliere/lafiliere_afficherliste.html.twig', ['detailfiliere' => $nbPageFiliere, "paginationFiliere"=>$PaginationFiliere]);

} elseif (isset($_GET['insertlafiliere'])) {
	
    if (isset($_POST['lenom'])) {
		
        $newfiliere = new lafiliere($_POST);
        //s($newfiliere,$_FILES);
        
        // si on attache une nouvelle images
        if ($_FILES['lepicto']['error']!=4) {
			
            $nouveauNom = uploadDoc::renameDoc($_FILES['lepicto']['name']);
			
            // changement du nom pour l'insertion dans la db
            $newfiliere->setLepicto($nouveauNom);
			
            // changement du nom pour l'upload de fichier
            $_FILES['lepicto']['name'] = $nouveauNom;
			
            // Appel de la classe statique updloadDoc dans laquelle on va chercher la méthode statique uploadFichier avec ::
            $upload = uploadDoc::uploadFichier($_FILES['lepicto'],
                    ['.png', '.gif', '.jpg', '.jpeg'], // on souhaite que des images
                    $folder=IMG_ORIGIN // on les mets dans le dossier imagesoriginales
                    );
					
            if (!$upload) {
				
                exit();
				
            // l'image a bien été envoyée    
            }else{
				
                // redimension avec proportion
                uploadDoc::uploadRedim($upload,IMG_MEDIUM,300,300,90);
				
                // redimension avec crop dans l'iamge
                uploadDoc::uploadThumb($upload,IMG_THUMB,50,50,80);
				
            }
			
        }
		
        // insertion dans la db
        $lafiliereM->filiereCreate($newfiliere);

        //d($newfiliere,$_POST,$_FILES);
       header("Location: ./?viewlafiliere");
	   
    } else {
		
        echo $twig->render('lafiliere/lafiliere_ajouter.html.twig');
		
    }
    
} elseif (isset($_GET['deletelafiliere']) && ctype_digit($_GET['deletelafiliere'])) {
	
    $idlafiliere = (int) $_GET['deletelafiliere'];
	
    // validated delete
    if (isset($_GET['ok'])) {
		
        $lafiliereM->filiereDelete($idlafiliere);
		
        header("Location: ./?viewlafiliere");
		
    } else {
		
        echo $twig->render('lafiliere/lafiliere_delete.html.twig', ['id' => $idlafiliere]);
		
    }
	
} elseif (isset($_GET["updatelafiliere"]) && ctype_digit($_GET["updatelafiliere"])) {
	
    // submit updating filiere
    if (isset($_POST['idlafiliere'])) {
		
        $updatelafiliere = new lafiliere($_POST);
		
        //s($_FILES);
		
        // si on attache une nouvelle images
        if ($_FILES['lepicto']['error']!=4) {
			
            $nouveauNom = uploadDoc::renameDoc($_FILES['lepicto']['name']);
			
            // changement du nom pour l'insertion dans la db
            $updatelafiliere->setLepicto($nouveauNom);
			
            // changement du nom pour l'upload de fichier
            $_FILES['lepicto']['name'] = $nouveauNom;
			
            // Appel de la classe statique updloadDoc dans laquelle on va chercher la méthode statique uploadFichier avec ::
            $upload = uploadDoc::uploadFichier($_FILES['lepicto'],['.png', '.gif', '.jpg', '.jpeg'], // on souhaite que des images
                    $folder=IMG_ORIGIN );
					
            if (!$upload) {
				
                exit();
				
            }else{
				
                // redimension avec proportion
                uploadDoc::uploadRedim($upload,IMG_MEDIUM,300,300,90);
				
                // redimension avec crop dans l'iamge
                uploadDoc::uploadThumb($upload,IMG_THUMB,50,50,80);
				
            }
			
        }
		
        //s($updatelafiliere);
        $lafiliereM->filiereUpdate($updatelafiliere, $_GET["updatelafiliere"]);
        
        header("Location: ./?viewlafiliere");
		
    } else {
		
        echo $twig->render('lafiliere/lafiliere_modifier.html.twig', ['section' => $lafiliereM->filiereSelectById($_GET['updatelafiliere'])]);
		
	}
	
} else {

if(!isset($_SESSION['bandeau'])){
    $pourEntree = true;
    $_SESSION['bandeau']=true;
}else{
    $pourEntree = false;
}
echo $twig->render('roles/pedagogique/pedagogique_homepage.html.twig', ['entree' => $pourEntree,"session"=>$_SESSION]);
}