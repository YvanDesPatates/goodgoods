<?php
require_once(File::build_path(array("model", "Model.php")));

class ModelPanier
{

    private $idPanier;
    private $mailUtilisateur;
    private $date;
    private $lignesPanier;


    public function __construct($idPanier = NULL, $mailUtilisateur = NULL, $date = NULL, $lignesPanier = NULL)
    {
        if (!is_null($mailUtilisateur) && !is_null($idPanier)) {
            $this->idPanier = $idPanier;
            $this->mailUtilisateur = $mailUtilisateur;
            $this->date = $date;
        }
        if (is_null($lignesPanier)) {
            $this->lignesPanier = [];
        } else {
            $this->lignesPanier = $lignesPanier;
        }
    }

    public function getIdPanier()
    {
        return $this->idPanier;
    }

    public function getMailUtilisateur()
    {
        return $this->mailUtilisateur;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getLignesPanier()
    {
        return $this->lignesPanier;
    }

    /**  Retourne un objet panier avec les infos de la base de données */
    static public function getPanierParMail($mailUtilisateur)
    {
        $sql = "SELECT idpanier, date FROM paniers WHERE mailUtilisateur = :mail";
        $req_prep = model::getPDO()->prepare($sql);
        $values = array('mail' => $mailUtilisateur);
        $req_prep->execute($values); // ici sont stockés l'id panier et la date
        $res = $req_prep->fetchAll();
        if (empty($res)) {
            self::creationPanierVide($mailUtilisateur);
            $sql = "SELECT idPanier, date FROM paniers WHERE mailUtilisateur = :mail";
            $req_prep = model::getPDO()->prepare($sql);
            $values = array('mail' => $mailUtilisateur);
            $req_prep->execute($values); // ici sont stockés l'id panier et la date
            $res = $req_prep->fetchAll();
        }
        $res = $res[0];
        $tab_produits = ModelPanier::getAllProduitsPanier($res['idpanier']);
        return new ModelPanier($res['idpanier'], $mailUtilisateur, $res['date'], $tab_produits);
    }

    /** - creer un panier vide et l'enregistre dans la base de donnée
     * - attention à ne pas créer deux panier pour la même personne ! */
    static public function creationPanierVide($mailUtilisateur)
    {
        // creation du panier dans la BDD
        $sql = "INSERT INTO `paniers` (`mailUtilisateur`)
                VALUES (:tag_mailUtilisateur)";
        $req_prep = model::getPDO()->prepare($sql);
        $values = array(
            "tag_mailUtilisateur" => $mailUtilisateur
        );
        $req_prep->execute($values);
    }

    /** Retourne un tableau des produits présents dans le panier en BDD
     * le tableau est indexé par idProduit avec une quantité associée */
    static public function getAllProduitsPanier($idPanier)
    {
        $sql = "SELECT idProduit, quantite FROM lignespanier WHERE idPanier = :idPanier";
        $req_prep = Model::getPDO()->prepare($sql);
        $values = array('idPanier' => $idPanier);
        $req_prep->execute($values);
        $res = [];
        foreach ($req_prep->fetchAll() as $ligne) {
            $res[$ligne['idProduit']] = $ligne['quantite'];
        }
        return $res;
    }

    public function ajoutProduitPanierBDD($idProduit)
    {
        if ($this->date == null) {
            Model::getPDO()->query("UPDATE paniers SET date = CURRENT_DATE() where idPanier = '$this->idPanier'");
        }
        $tab_lignePanier = Model::getPDO()->query("SELECT * FROM lignespanier 
                                                    WHERE idProduit = '$idProduit' 
                                                    AND idPanier = '$this->idPanier'")->fetchAll();
        if (empty($tab_lignePanier[0])) { // si le produit n'est pas déjà présent dans le panier
            Model::getPDO()->query("INSERT INTO `lignespanier` (`idProduit`, `idPanier`, `quantite`)
                                        VALUES ('$idProduit', '$this->idPanier', 1)");
        } else {
            $quantite = Model::getPDO()->query("SELECT quantite FROM lignespanier 
                                                WHERE idProduit = '$idProduit' 
                                                AND idPanier = '$this->idPanier'")->fetchAll()[0]['quantite'];
            $quantite++;
            $req = Model::getPDO()->query("UPDATE lignespanier SET quantite = '$quantite' 
                                            WHERE idProduit = '$idProduit' AND idPanier = '$this->idPanier'");
        }
    }

    public function ajoutProduitPanierObjet($idProduit)
    {
        if ($this->date == null) {
            $this->date = date("m.d.y");
        }
        if (isset($this->lignesPanier[$idProduit])) { // si le produit n'est pas déjà présent dans le panier
            $this->lignesPanier[$idProduit]++;
        } else {
            $this->lignesPanier[$idProduit] = 1;
        }
    }

    public function suppProduitPanierBDD($idProduit)
    {
        $tab_lignePanier = Model::getPDO()->query("SELECT * FROM lignespanier
                                                    WHERE idProduit = '$idProduit'")->fetchAll();
        $quantite = $tab_lignePanier[0]['quantite'];
        if ($quantite == 1) {
            Model::getPDO()->query("DELETE FROM lignespanier WHERE idProduit = '$idProduit'");
            $estVide = Model::getPDO()->query("SELECT * FROM lignespanier");
            if ($estVide){
                Model::getPDO()->query("UPDATE paniers SET date = NULL
                                    WHERE idPanier = $this->idPanier");
            }
        } else {
            $quantite -= 1;
            Model::getPDO()->query("UPDATE lignespanier SET quantite = '$quantite'
                                        WHERE idProduit = '$idProduit' AND idPanier = '$this->idPanier'");
        }
    }

    public function suppProduitPanierObjet($idProduit)
    {
        $indice = $this->lignesPanier[$idProduit];
        if (isset($this->lignesPanier[$idProduit]) && $indice == 1) {
            unset($this->lignesPanier[$idProduit]);
        } else {
            $this->lignesPanier[$idProduit]--;
        }
        if (empty($this->lignesPanier)){
            $this->date = null;
        }
    }

    public function viderPanierBDD()
    {
        Model::getPDO()->query("DELETE FROM lignespanier WHERE idPanier = '$this->idPanier'");
    }

    public function viderPanierObjet()
    {
        $this->lignesPanier = [];
    }

}
