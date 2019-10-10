<?php
require_once '../../config.php';

require_once '../../vendor/autoload.php';

if (!empty($_FILES)) {
    // création de l'instance d'upload
    $upload = new FzUpload\Core();
    $upload->setFile($_FILES['pictures']);
    $upload->setSaveDirectory([__DIR__ . "\upload"]);
    //get file informations
    $return = $upload->getFile();

    switch ($return[0]['mimeType']) {
        case "image/jpeg":
            $upload->setSaveImageAs(['jpg|100']);
            break;
        case "image/gif":
            $upload->setSaveImageAs(['gif']);
            break;
        case "image/png":
            $upload->setSaveImageAs(['png|100']);
            break;
        default :
            $upload->setSaveImageAs(['jpg|100']);
    }
    // nom et position pour les redimensions
    $pourRedim = __DIR__ . "\upload\\" . $return[0]['completeRandomName'];
    s($pourRedim);
    // prépare les dossier
    $upload->uploadFile();
    //save file to local server
    if ($upload->saveLocal()) {

        //files uploaded
        $filesUploaded = $upload->getSavedFiles();
    } else {
        //error
    }
    
    // miniature
    $upload = new FzUpload\Core();
    $upload->setFile($_FILES['pictures']);
    $upload->setSaveDirectory([__DIR__ . "\upload\min"]);
    //get file informations
    $return = $upload->getFile();
     switch ($return[0]['mimeType']) {
        case "image/jpeg":
            $upload->setSaveImageAs(['jpg|100']);
            break;
        case "image/gif":
            $upload->setSaveImageAs(['gif']);
            break;
        case "image/png":
            $upload->setSaveImageAs(['png|100']);
            break;
        default :
            $upload->setSaveImageAs(['jpg|100']);
    }
    $upload->imageResize(100, 200);
    if($upload->saveLocal()) {
    //success
        $filesUploaded = $upload->getSavedFiles();
}else{
    //error
}
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>php-upload-server</title>
    </head>
    <body>
        <h1>php-upload-server</h1>
        <p><a href="https://github.com/FernandoZueet/php-upload-server" target="_blank">fernandozueet/php-upload-server</a></p>
        <p>Installation : composer require fernandozueet/php-upload-server</p>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000"/>
            <input type="file" name="pictures" accept="image/*"/>
            <input type="submit" value="upload"/>
<?php
if (isset($return)) {
    s($return,$pourRedim);
}
?>
        </form>
    </body>
</html>
