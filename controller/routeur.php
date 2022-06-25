<?php

require_once File::build_path(array('controller', "ControllerPanier.php"));
require_once File::build_path(array('controller', "ControllerProduit.php"));
require_once File::build_path(array('controller', "ControllerUtilisateur.php"));
require_once File::build_path(array('controller', 'ControllerCommande.php'));

session_start();

$myPost = array_values($_GET);

// On recupère l'action passée dans l'URL
if(empty($_GET)){
    //creation d'un panier temp dans $SESSION a detruire en cas de connexion
    ControllerProduit::readAll();

} else {
    $action = $_GET['action'];
    $controller = $_GET['controller'];
    switch (sizeof($myPost)-2) { # chaque cas = un nombre d'arguments
        case 1 : $controller::$action($myPost[2]); break;
        case 2 : $controller::$action($myPost[2], $myPost[3]); break;
        case 3 : $controller::$action($myPost[2], $myPost[3], $myPost[4]); break;
        case 4 : $controller::$action($myPost[2], $myPost[3], $myPost[4], $myPost[5]); break;
        case 5 : $controller::$action($myPost[2], $myPost[3], $myPost[4], $myPost[5], $myPost[6]); break;
        default : $controller::$action(); break;
    }
}

