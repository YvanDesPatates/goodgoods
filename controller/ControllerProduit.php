<?php
require_once(File::build_path(array("model", "ModelProduit.php")));

class ControllerProduit {
    public static function readAll($categorie = NULL) {
        if ($categorie == NULL){$tab_p = ModelProduit::getAllProduits();}
        else {$tab_p = ModelProduit::getProduitsParCategorie($categorie);}
        $view='produits';
        $pagetitle='Nos Good Goods';
        require(File::build_path(array("view", "view.php")));
    }
}


