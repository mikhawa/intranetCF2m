<?php
$linscriptionManager = new lutilisateurManager($db_connect);

if (isset($_GET['createLinscription'])) {

        if (empty($_POST)) {


            // appel de la vue
            echo $twig->render("ajoutLinscription.html.twig");
        } else {

            // on crée une instance de thesection avec le formulaire POST en paramètre
            $insert = new linscription($_POST);

            // on appel le manager et on utilise la méthode d'insertion (true en cas de réussite et false en cas d'échec)

            $forinsert = $linscriptionManager->linscriptionCreate($insert);

            // si l'insertion est réussie
            if ($forinsert) {
                header("Location: ./");
            } else {

                // appel de la vue avec affichage d'une erreur
                echo $twig->render("public/homepage.html.twig", ["error" => "Erreur lors de l'insertion, veuillez recommencer"]);

            }


        }

    }else{
    $section = $linscriptionManager->lutilisateurSelectAll();

// on appelle la vue générée par twig

    echo $twig->render('ajoutLinscription.html.twig',['section'=>$section]);
}


// page d'accueil

    // lien vers la page d'accueil
    echo $twig->render("public/homepage.html.twig");