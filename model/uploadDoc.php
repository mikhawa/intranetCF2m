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
        $newName = date("YmdHis").mt_rand(1000,9999);
        
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

}
