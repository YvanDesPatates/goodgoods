<h3 style="text-align: center">Mes commandes</h3>
<?php
    if (isset($_SESSION['utilisateur'])) {
        foreach (ModelCommande::getAllCommandes($_SESSION['utilisateur']->getMail()) as $commande){
            echo "<div style='width: 100%; display: flex; flex-direction: column; justify-content: center; align-items: center'>
                    <div style='border: solid; width: 80%; text-align: center; margin: 30px'>
                        <div style='border-bottom: solid'> commande du {$commande->getDate()}</div>
                        <div style='display: flex; width: 100%; justify-content: space-between'>
                            <div style='border-right: solid; text-align: center'> numéro de commande : {$commande->getIdCommande()} </div>
                            <div style='border-right: solid; text-align: center'> nombre d'article : {$commande->getNbArticles()}</div>
                            <div style='border-right: solid; text-align: center'> montant total : {$commande->getPrixTotal()}€ </div>
                            <div style='text-align: center'> <a href='indexx.php?action=read&controller=ControllerCommande&idCommande={$commande->getIdCommande()}'>voir ma commande</a></div>
                         </div>
                    </div>
                  </div>";
        }

    } else {header('Location: indexx.php');} // juste au cas où on essaierais d'accéder à la page sans être connecté