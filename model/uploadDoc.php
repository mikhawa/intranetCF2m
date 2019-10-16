<?php

/**
 * Description of uploadDoc
 *
 * Classe permettant l'upload de fichiers
 */
class uploadDoc {

    // attributs
    
    // static fonction pour créer un nom de fichier unqiue
    public static function renameDoc($originName){
        // récupération de l'extension d'origine
        $extension = strrchr($originName, '.');
        
        // création d'un nom avec la date plus un chiffre au hasard pour soit unique (et classé)
        $newName = date("YmdHis").mt_rand(10000,99999);
        
        // envoie du nouveau nom avec l'extension d'origine
        return $newName.$extension;
    }
    
    // static function, peuvent être appelées sans instanciation de la classe avec les :: par exemple uploadDoc::uploadFichier avec le $_FILES envoyé sous forme de tableau nommé $data, et un argument qui a déjà des valeurs par défauts, on peut les changer au cas où on décide l'upload de fichier spécique

    public static function uploadFichier(array $datas, // le $_FILES
            array $extensions = [
        '.png', // img
        '.gif', // img
        '.jpg', // img
        '.jpeg',// img
        ".svg", // img
        ".pdf", // doc
        ".doc", // doc
        ".docx",// doc
        ".txt", // txt
        ".rtf",// doc
        ".tiff", // img
        ".psd", // photoshop
        ".xls", // accès
        ".odt", // openoffice
        ".ppt" // powerpoint
        ], // les extensions acceptées
        $folder=UPLOAD_FILE // le chemin de sauvegarde
        ) {


        $dossier = $folder;
        $fichier = basename($datas['name']);
        $taille_maxi = 128000000;
        $taille = filesize($datas['tmp_name']);
        $extension = strrchr($datas['name'], '.');
        //Début des vérifications de sécurité...
        if (!in_array($extension, $extensions)) { //Si l'extension n'est pas dans le tableau
            $erreur = 'Vous devez uploader un fichier de type ...';
        }
        if ($taille > $taille_maxi) {
            $erreur = 'Le fichier est trop gros...';
        }
        if (!isset($erreur)) { //S'il n'y a pas d'erreur, on upload

            if (move_uploaded_file($datas['tmp_name'], $dossier . $fichier)) { //Si la fonction renvoie TRUE, c'est que ça a fonctionné..., on renvoie le chemin du fichier
                return $dossier . $fichier;
            } else { //Sinon (la fonction renvoie FALSE).
                echo 'Echec de l\'upload !';
                return false;
            }
        } else {
            echo $erreur;
            return false;
        }
    }
    
    // redimension de l'image
    public static function uploadRedim(string $cheminOriginal, string $dossierFinal, int $Large, int $Haut, int $qualite=90){

        $nomFichier = strrchr($cheminOriginal, '\\');

        $taille_original = getimagesize($cheminOriginal);

        $largeurOri = $taille_original[0];
        $hauteurOri = $taille_original[1];

        // si l'image est plus petite en hauteur comme en largeur que les dimensions maximales, inutile de redimensionner
        if ($hauteurOri <= $Haut && $largeurOri <= $Large) {
            // taille originale
            $newWidth = $largeurOri;
            $newHeight = $hauteurOri;
        } else {
            // si l'image est en paysage
            if ($largeurOri > $hauteurOri) {
                $ratio = $Large / $largeurOri;
                // nous sommes en portrait ou l'image est carré
            } else {
                $ratio = $Haut / $hauteurOri;
            }
            // valeurs arrondies en pixel
            $newWidth = round($largeurOri * $ratio);
            $newHeight = round($hauteurOri * $ratio);
        }
        // on va créer les copies d'images suivant le type MIME de celles-ci (copier)
        switch ($taille_original['mime']) {
            case "image/jpeg":
            case "image/pjpeg":
                $nouvelle = imagecreatefromjpeg($cheminOriginal);
                break;
            case "image/gif":
                $nouvelle = imagecreatefromgif($cheminOriginal);
                break;
            case "image/png":
                $nouvelle = imagecreatefrompng($cheminOriginal);
                break;
            default:
                die("Format de fichier incorrecte");
        }

        // on va créer l'image réceptrice de notre copie avec les dimensions souhaitées (create)
        $newImage = imagecreatetruecolor($newWidth, $newHeight);

        // on va "coller" l'image originale dans la nouvelle image
        imagecopyresampled($newImage, $nouvelle, 0, 0, 0, 0, $newWidth, $newHeight, $largeurOri, $hauteurOri);

        // on crée physiquement l'image
        switch ($taille_original['mime']) {
            case "image/jpeg":
            case "image/pjpeg":
                $nouvelle = imagejpeg($newImage, $dossierFinal.$nomFichier, $qualite);
                break;
            case "image/gif":
                $nouvelle = imagegif($newImage, $dossierFinal.$nomFichier, $qualite);
                break;
            case "image/png":
                $nouvelle = imagepng($newImage, $dossierFinal.$nomFichier, $qualite);
                break;
            default:
                die("Format de fichier incorrecte");
        }
        return true;
    }
    
    public static function uploadThumb(string $cheminIMG,$Large,$Haut){
        //echo $cheminIMG,$Large,$Haut;
    }
    

}
