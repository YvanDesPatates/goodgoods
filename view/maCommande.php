<?php
require_once File::build_path(array('model', 'ModelProduit.php'));

echo "<h2>Votre commande N°{$commande->getIdCommande()}</h2>
      <h3>Total TTC : {$commande->getPrixTotal()}€ </h3>";

echo "<div style='display: flex; flex-direction: column; justify-content: center'>
      <div class='listeProduit'>";
foreach ($commande->getLignesCommande() as $idProduit => $quantite) {
    $p = ModelProduit::getProduitParId($idProduit);
    $source = "img/".$p->getIdProduit().'.png';

    echo "<div class='cadre' style='width : 80%; display: flex;'>
                <div><img class='gif' style='width:30%' src='" . $source . "'>
                     <h2>" . $p->getNom() . "</h2>
                </div>
                <div>
                    <h3> prix : {$p->getPrix()}€</h3>
                    <h3> quantité : $quantite </h3>
                    <h3> produit N°{$p->getIdProduit()}</h3>
                    <p>" . $p->getDescription() . "</p>
                </div>
           </div>";
}
echo "</div> </div>";
