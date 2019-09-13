<?php

// on appelle l'a vue générée par twig l'accueil du superAdmin
    echo $twig->render('roles/admin/admin_homepage.html.twig',['session'=>$_SESSION]);

