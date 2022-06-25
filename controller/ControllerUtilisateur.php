<?php

require(File::build_path(array("model", "ModelUtilisateur.php")));
require_once (File::build_path(array("controller", 'ControllerProduit.php')));

class ControllerUtilisateur {

    public static function formConnexion(){
        $view='connexion';
        $pagetitle='Se connecter';
        require(File::build_path(array("view", "view.php")));
    }

    public static function formCreationCompte(){
        $view='creationCompte';
        $pagetitle='Créez un compte';
        require(File::build_path(array("view", "view.php")));
    }

    /** trouve les infos correspondants à l'utilisateurs et créer un objet utilisateur stocké dans session
     * si l'association mail/mdp ne corresponds à personne dans la base, renvoies vers une page d'erreur */
    public static function connexion($mail, $mdp){
        $utilisateur = ModelUtilisateur::getUtilisateur($mail, $mdp);
        if ($utilisateur == false){
            $view='erreur_connexion';
            $pagetitle='Erreur connexion';
            require File::build_path(array("view", "view.php"));
        } else {
            $_SESSION['utilisateur'] = $utilisateur;
            $_SESSION['panier'] = ModelPanier::getPanierParMail($mail);
            if ($utilisateur->getEstAdmin() == 0) {
                ControllerProduit::readAll();
            } else {
                ControllerUtilisateur::home();
            }
        }
    }

    public static function deconnexion(){
        unset($_SESSION['utilisateur']);
        unset($_SESSION['panier']);
        ControllerProduit::readAll();
    }

    /** créer un objet utilisateur et le sauvegarde dans la base de donnée
    si il manque le mail ou le mdp on renvois sur une page d'erreur*/
    public static function creerCompte($mail, $mdp, $prenom, $nom, $adresse){
        if ($mail!='' && ModelUtilisateur::mailEstDisponible($mail) && $mdp!='' && !is_null($mdp)) {
            $utilisateur = new ModelUtilisateur($mail, $mdp, $nom, $prenom, $adresse);
            $utilisateur->save();
            ControllerUtilisateur::connexion($mail, $mdp);
        }else {
            $view = 'erreur_connexion';
            $pagetitle = 'Erreur connexion';
            require File::build_path(array("view", "view.php"));
        }
    }

//    FONCTION ADMIN

    /** créer un objet utilisateur et le sauvegarde dans la base de donnée
    si il manque le mail ou le mdp on renvois sur une page d'erreur*/
    public static function adminCreerCompte($mail, $mdp, $prenom, $nom, $adresse, $estAdmin){
        if ($mail!='' && ModelUtilisateur::mailEstDisponible($mail) && $mdp!='' && !is_null($mdp)) {
            $utilisateur = new ModelUtilisateur($mail, $mdp, $nom, $prenom, $adresse, $estAdmin);
            $utilisateur->save();
        }else {
            $view = 'admin/ajouterUtilisateur';
            $pagetitle = 'Ajout utilisateur';
            echo "Erreur lors de l'ajout de l'utilisateur.";
            require File::build_path(array("view", "view.php"));
        }
    }

    public static function home(){
        $view = 'admin/home';
        $pagetitle = 'BackOffice';
        require(File::build_path(array("view", "view.php")));
    }


    public static function adminFormCreationCompte(){
        $view='admin/ajouterUtilisateur';
        $pagetitle='Ajouter un utilisateur';
        require(File::build_path(array("view", "view.php")));
    }

    public static function modifierCompte($prenom, $ancienMdp, $nouveauMdp){
        $utilisateur = $_SESSION['utilisateur'];
        $utilisateur->setPrenomEtBDD($prenom);

        if (! $utilisateur->setMdpEtBDD($ancienMdp, $nouveauMdp)){
            $view = 'erreur_changementMdp';
            $pagetitle = 'Erreur MotDePasse';
            require File::build_path(array("view", "view.php"));
        }else header('Location: indexx.php');
    }

    public static function formModifierCompte(){
        $view = 'modificationCompte';
        $pagetitle = 'Modifier mon compte';
        require File::build_path(array("view", "view.php"));
    }

    }


