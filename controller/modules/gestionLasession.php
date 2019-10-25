<?php

/*
 *
 * Module de gestion de lasession
 *
 */

switch ($_SESSION['idlerole']) {

    // référent pédagogique
    case 3:


        break;
    // admin
    case 4:


// Delete
        if (isset($_GET['confirmationdeletelasession']) && ctype_digit($_GET['confirmationdeletelasession'])) {
            $lasessionM->sessionDelete($_GET['confirmationdeletelasession']);
            header('Location: ./?viewlasession');

// Update
        } else if (isset($_POST['idlasession']) && ctype_digit($_POST['idlasession']) && isset($_POST['lenom']) && isset($_POST['lacronyme']) && isset($_POST['lannee']) && ctype_digit($_POST['lannee']) && isset($_POST['lenumero']) && ctype_digit($_POST['lenumero']) && isset($_POST['letype']) && ctype_digit($_POST['letype']) && isset($_POST['debut']) && isset($_POST['fin']) && isset($_POST['lafiliere_idfiliere']) && ctype_digit($_POST['lafiliere_idfiliere'])) {
            $lasession = new lasession($_POST);
            $lasessionM->sessionUpdate($lasession);
            header('Location: ./?viewlasession');


// INSERT
        } else if (isset($_POST['lenom']) && isset($_POST['lacronyme']) && isset($_POST['lannee']) && ctype_digit($_POST['lannee']) && isset($_POST['lenumero']) && ctype_digit($_POST['lenumero']) && isset($_POST['letype']) && ctype_digit($_POST['letype']) && isset($_POST['debut']) && isset($_POST['fin']) && isset($_POST['lafiliere_idfiliere']) && ctype_digit($_POST['lafiliere_idfiliere'])) {
            $lasession = new lasession($_POST);
            $lasessionM->sessionCreate($lasession);
            header('Location: ./?viewlasession');
        }

// Display views for sessions

// accueil
        elseif (isset($_GET['viewlasession'])) {
            echo $twig->render("lasession/lasession_afficherliste.html.twig", ['detailsession' => $lasessionM->sessionSelectALL()]);

// vue d'update
        } elseif (isset($_GET['updatelasession']) && ctype_digit($_GET['updatelasession'])) {
            echo $twig->render("lasession/lasession_modifier.html.twig", ['detailsession' => $lasessionM->sessionSelectByID($_GET['updatelasession']), "filieres" => $lafiliereM->filiereSelectAll()]);

// vue d'insertion
        } elseif (isset($_GET['insertlasession'])) {
            echo $twig->render("lasession/lasession_ajouter.html.twig", ["filieres" => $lafiliereM->filiereSelectAll()]);
        }

        break;

    default:
        echo "<h3>lasession: <small>Il n'est pas prévu que vous puissiez utiliser ce module!</small></h3>";
}

