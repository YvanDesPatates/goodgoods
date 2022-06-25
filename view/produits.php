<?php

echo "<div class='cadre'>"; // div liste produits (à gauche)
foreach ($tab_p as $p) {
    $source = "img/".$p->getIdProduit().'.png';

    echo "<div class='produit'>
                    <h2>" . $p->getNom() . "</h2>
                    <img class='gif' style='width:15%' src='" . $source . "'>
                    <p>" . $p->getDescription() . "</p>
                    <h3>" . $p->getPrix() . "€</h3>
                    <a href='indexx.php?action=majPanierAjout&controller=ControllerPanier&id=" . $p->getIdProduit() . "&view=produits'>Ajouter au panier</a>
             </div>";
}
echo "</div>"; // div liste produits (à gauche)



?>
<!--</body>-->
<!--</html>-->