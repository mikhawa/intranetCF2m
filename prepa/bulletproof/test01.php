<?php

require_once '../../config.php';

require_once '../../vendor/autoload.php';


if(!empty($_FILES)){
    $image = new Bulletproof\Image($_FILES);
    $image->setName("test01")
      ->setLocation(__DIR__ . "/avatars");

if($image["pictures"]){
  $upload = $image->upload(); 

  if($upload){
    echo $upload->getFullPath(); // uploads/cat.gif
    /* ne fonctionne pas en OO car pas une classe !
    new Bulletproof\Utils\resize(
			$image->getFullPath(), 
			$image->getMime(),
			$image->getWidth(),
			$image->getHeight(),
			100,
			100
	 );
     * 
     */
  }else{
    echo $image->getError(); 
  }
}
}



?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>samayo/bulletproof</title>
    </head>
    <body>
        <h1>samayo/bulletproof</h1>
        <h2>A simple and secure PHP image uploader</h2>
        <form method="POST" enctype="multipart/form-data">
  <input type="hidden" name="MAX_FILE_SIZE" value="128000000"/>
  <input type="file" name="pictures" accept="image/*"/>
  <input type="submit" value="upload"/>
</form>
    </body>
</html>
