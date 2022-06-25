<?php
require_once(File::build_path(array("model", "Model.php")));

class ModelProduit
{

    private $idProduit;
    private $nom;
    private $prix;
    private $description;


    public function __construct($idProduit = NULL, $nom = NULL, $prix = NULL, $description = NULL)
    {
        if (!is_null($idProduit) && !is_null($nom) && !is_null($prix) && !is_null($description)) {
            $this->idProduit = $idProduit;
            $this->nom = $nom;
            $this->prix = $prix;
            $this->description = $description;
        }
    }


    // méthode d'obtention de tous les produits
    static public function getAllProduits()
    {
        $rep = Model::getPDO()->query("SELECT * FROM produits");  //obtenir une réponse illisible à la requête
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelProduit');        //rendre lisible la réponse en transformant en classe
        return $rep->fetchAll();
    }

    /** renvoies un objet Produit avec les informations du produit demandé
     * retourne faux si aucun id ne correspond à celui demandé */
    static public function getProduitParId($idProduit)
    {
        $sql = "SELECT * from produits WHERE idProduit=:idProduit";
        $req_prep = Model::getPDO()->prepare($sql);
        $values = array("idProduit" => $idProduit);
        $req_prep->execute($values);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelProduit');
        $tab = $req_prep->fetchAll();
        if (empty($tab))
            return false;
        return $tab[0];
    }

    public static function getProduitsParCategorie($categorie){
        $rep = Model::getPDO()->query("SELECT * FROM produits WHERE nomCategorie = '$categorie'");
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelProduit');
        return $rep->fetchAll();
    }

    public static function getAllCategories(){
        $rep = Model::getPDO()->query("SELECT * FROM categories");
        return $rep->fetchAll();
    }

    public function getIdProduit()
    {
        return $this->idProduit;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    public function getDescription()
    {
        return $this->description;
    }

}

