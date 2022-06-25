<?php
require_once(File::build_path(array("model", "Model.php")));
require_once (File::build_path(array("model", "ModelProduit.php")));

class ModelCommande
{
    private $idCommande;
    private $mailUtilisateur;
    private $date;
    private $lignesCommande;


    public function __construct($idCommande, $mailUtilisateur, $date, $lignesCommande)
    {
        $this->idCommande = $idCommande;
        $this->mailUtilisateur = $mailUtilisateur;
        $this->date = $date;
        $this->lignesCommande = $lignesCommande;
    }

    /** renvoies un objet Commande correspondant à l'id
     * retourne faux si aucun id ne correspond à celui demandé */
    static public function getCommandeParId($idCommande)
    {
        $sql = "SELECT * from commandes WHERE idcommande=:idCommande";
        $req_prep = Model::getPDO()->prepare($sql);
        $values = array("idCommande" => $idCommande);
        $req_prep->execute($values);
        $tab = $req_prep->fetchAll()[0];
        if (empty($tab))
            return false;
        $tab_produits = self::getAllProduitsCommande($idCommande);
        return new ModelCommande($idCommande, $tab['mailUtilisateur'], $tab['date'], $tab_produits);
    }

    /** Retourne un tableau des produits présents dans la Commande en BDD
     * le tableau est indexé par idProduit avec une quantité associée */
    static public function getAllProduitsCommande($idCommande)
    {
        $sql = "SELECT idProduit, quantite FROM lignescommande WHERE idCommande = :idCommande";
        $req_prep = Model::getPDO()->prepare($sql);
        $values = array('idCommande' => $idCommande);
        $req_prep->execute($values);
        $res = [];
        foreach ($req_prep->fetchAll() as $ligne) {
            $res[$ligne['idProduit']] = $ligne['quantite'];
        }
        return $res;
    }

    /** retourne un tableau d'objets commandes appartenant au mailUtilisateur passé en paramètre
        Le tableau est indicé par les idCommandes  */
    static public function getAllCommandes($mailUtilisateur){
        $sql = "SELECT idCommande FROM commandes WHERE mailUtilisateur = :mailUtilisateur";
        $req_prep = Model::getPDO()->prepare($sql);
        $values = array('mailUtilisateur' => $mailUtilisateur);
        $req_prep->execute($values);
        $res = [];
        foreach ($req_prep->fetchAll() as $idCommande) {
            $res[$idCommande[0]] = self::getCommandeParId($idCommande[0]);
        }
        return $res;
    }

    /** prends en paramètre un objet panier, le transforme en objet commande et l'insère dans la BDD
        retourne un l'objet commande en question   */
    Static public function EnregistrerPanierEnCommande($panier){
        // création de la commande
        $req_prep = Model::getPDO()->prepare("INSERT INTO commandes (date, mailUtilisateur) VALUES (CURRENT_DATE(), :mail)");
        $req_prep->execute(array('mail' => $panier->getMailUtilisateur()));

        // récupération de l'id de la commande généré par Mysql
        $req_id = Model::getPDO()->prepare("SELECT MAX(idCommande) FROM commandes WHERE mailUtilisateur = :mail");
        $req_id->execute(array('mail' => $panier->getMailUtilisateur()));
        $idCommande = $req_id->fetchAll()[0][0];

        // insertion des lignesCommandes correspondantes aux lignesPanier
        Model::getPDO()->query("INSERT INTO lignescommande (idProduit, quantite, idCommande)
                                SELECT idProduit, quantite, $idCommande FROM lignespanier WHERE idPanier = '".$panier->getidPanier()."'");

        return self::getCommandeParId($idCommande);
    }

    public function getIdCommande()
    {
        return $this->idCommande;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getLignesCommande()
    {
        return $this->lignesCommande;
    }

    public function getNbArticles(){
        $somme = 0;
        foreach ($this->lignesCommande as $quantite)
            $somme += $quantite;
        return $somme;
    }

    public function getPrixTotal(){
        $total = 0;
        foreach ($this->lignesCommande as $idProduit => $quantite){
            $produit = ModelProduit::getProduitParId($idProduit);
            $total += $produit->getPrix()*$quantite;
        }
        return $total;
    }




}