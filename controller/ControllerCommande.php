<?php
require_once(File::build_path(array('model', 'ModelCommande.php')));
require_once File::build_path(array('model', 'ModelPanier.php'));

class ControllerCommande
{
    public static function readAll(){
        $view='mesCommandes';
        $pagetitle='Mes commandes';
        require(File::build_path(array("view", "view.php")));
    }

    public static function read($idCommande){
        $commande = ModelCommande::getCommandeParId($idCommande);
        $view='maCommande';
        $pagetitle="Commande N°{$commande->getIdCommande()}";
        require(File::build_path(array("view", "view.php")));
    }

    public static function panierVersCommande(){
        $panier = $_SESSION['panier'];
        $commande = ModelCommande::EnregistrerPanierEnCommande($panier);
        $panier->viderPanierObjet();
        $panier->viderPanierBDD();
        self::read($commande->getIdCommande());
    }

}