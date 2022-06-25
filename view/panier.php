<?php
$prixTotalPanier = 0;
if (empty($panier->getLignesPanier())) {
    echo "<h3> vous n'avez rien dans votre panier, pour revenir aux achats cliquez <a href='indexx.php'>ici</a></h3>";
} else {
    echo "<div>Mon panier</div>";
    echo "<div class='tabPanier'>
    <table class='produitPanier'>
        <thead>
            <tr class='tab'>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Montant total</th>
            </tr>
        </thead>
        <tbody >";
            foreach ($panier->getLignesPanier() as $id => $qte) {
                $produit = ModelProduit::getProduitParId($id);
                $prixTotal = $produit->getPrix() * $qte;
                $prixTotalPanier += $prixTotal;
                echo "<tr class='tab'> 
                <td>".$produit->getNom()."</td>
                <td>".$qte."</td>
                <td>".$produit->getPrix()." €</td>
                <td>".$prixTotal." €</td>   
                <th><a href='indexx.php?action=majPanierAjout&controller=ControllerPanier&id=$id&view=panier'>+</a></th>
                <th><a href='indexx.php?action=majPanierSupp&controller=ControllerPanier&id=$id'>-</a></th></tr>";

            }
            echo " </tbody >
    </table >";
    echo "<div> 
                    <p>TVA (20%) : ".$prixTotalPanier*0.2." €</p>
                    <p>prix Total : $prixTotalPanier €</p>
                    
        </div>
        </div> ";

        if (isset($_SESSION['utilisateur']))
            echo "<a href='indexx.php?action=panierVersCommande&controller=ControllerCommande'> Transformer en commande</a>";
}

