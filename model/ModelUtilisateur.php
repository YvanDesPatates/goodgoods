<?php

require_once File::build_path(array("model", "Model.php"));

class ModelUtilisateur{
    private $mail;
    private $mdp;
    private $nom;
    private $prenom;
    private $adresse;
    private $estAdmin;


    public function __construct($mail=NULL, $mdp=NULL, $nom=NULL, $prenom=NULL, $adresse=NULL){
        if (!is_null($mail) && !is_null($mdp) && !is_null($nom) && !is_null($prenom) && !is_null($adresse)) {
            $this->mail = $mail;
            $this->mdp = $mdp;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->adresse = $adresse;
            $this->estAdmin = 0;
        }
    }

    /** retourne un utilisateur, retourne faux si aucun utilisateur ne corresponds à l'association mail/mdp */
    static function getUtilisateur($mail, $mdp){
        $sql = "SELECT * FROM utilisateurs WHERE mail=:mail AND mdp=:mdp";
        $req_prep = Model::getPDO()->prepare($sql);
        $values = array("mail" => $mail, "mdp" => $mdp);
        $req_prep->execute($values);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
        $utilisateur = $req_prep->fetchAll();
        if (empty($utilisateur))
            return false;
        return $utilisateur[0];
    }

    /** créer un nouvel utilisateur avec un panier vide*/
    public function save(){
        try {
            $sql = "INSERT INTO `utilisateurs` (`mail`, `mdp`, `nom`, `prenom`, `adresse`) 
                    VALUES (:mail, :mdp, :nom, :prenom, :adresse);";
            $req_prep = Model::getPDO()->prepare($sql);
            $values = array("mail" => $this->mail,
                "mdp" => $this->mdp,
                "nom" => $this->nom,
                "prenom" => $this->prenom,
                "adresse" => $this->adresse
            );
            $req_prep->execute($values);
        }catch (PDOException $e){
            echo '<h2>Une erreur est survenue lors de la création de votre compte <a href="indexx.php"> retour a la page d\'accueil </a></h2>';
            die();
        }
    }

    /** créer un nouvel utilisateur ou un administrateur avec un panier vide*/
    public function adminSave(){
        try {
            $sql = "INSERT INTO `utilisateurs` (`mail`, `mdp`, `nom`, `prenom`, `adresse`, `estAdmin`) 
                    VALUES (:mail, :mdp, :nom, :prenom, :adresse, :estAdmin);";
            $req_prep = Model::getPDO()->prepare($sql);
            $values = array("mail" => $this->mail,
                "mdp" => $this->mdp,
                "nom" => $this->nom,
                "prenom" => $this->prenom,
                "adresse" => $this->adresse,
                "estAdmin" => $this->estAdmin
            );
            $req_prep->execute($values);
        }catch (PDOException $e){
            echo '<h2>Une erreur est survenue lors de la création de votre compte <a href="indexx.php"> retour a la page d\'accueil </a></h2>';
            die();
        }
    }

    /** vérifie qu'un mail ne soit pas déjà utilisé par un compte
     retourne true si le mail est libre, false si il est déjà utilisé*/
    static function mailEstDisponible($mail){
        $sql = "SELECT mail FROM utilisateurs";
        $req_prep = Model::getPDO()->prepare($sql);
        $req_prep->execute();
        $tab_mails = $req_prep->fetchAll();
        foreach ($tab_mails as $res){
            if ($res[0] == $mail){return false;}
        }
        return true;
    }


    public function __toString()
    {
        return $this->prenom." ".$this->nom." adresse mail : ".$this->mail;
    }


    public function getMail()
    {
        return $this->mail;
    }

    public function getMdp()
    {
        return $this->mdp;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function getEstAdmin(){
        return $this->estAdmin;
    }

    /** retourne faux si l'ancien mdp n'est pas juste
        retourne vrai sinon
     * actualise le mot de passe et la BDD à condition que le mdp ne soit pas vide
     */
    public function setMdpEtBDD($ancienMdp, $nouveauMdp){
        if ($nouveauMdp != "") {
            if ($ancienMdp == $this->mdp ) {
                $req = Model::getPDO()->prepare("UPDATE utilisateurs SET mdp = :mdp WHERE mail = '$this->mail'");
                $values = array("mdp" => $nouveauMdp);
                $req->execute($values);
                $this->mdp = $nouveauMdp;
                return true;
            }
            return false;
        }
        return true;

    }

    /** change le prenom de l'objet et en BDD a condition que le prenom ne sois pas vide */
    public function setPrenomEtBDD($prenom)
    {
        if ($prenom != "") {
            $this->prenom = $prenom;
            $req = Model::getPDO()->prepare("UPDATE utilisateurs SET prenom = :prenom WHERE mail = '$this->mail'");
            $values = array("prenom" => $prenom);
            $req->execute($values);
        }
    }







}