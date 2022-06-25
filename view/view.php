<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="view/style.css">
    <title><?php echo $pagetitle; ?></title>
</head>
<header>


    <div class="session">
        <?php
        if (isset($_SESSION['utilisateur'])) {
            echo "<p>Bonjour ".$_SESSION['utilisateur']->getprenom()."</p>";
            if ($_SESSION['utilisateur']->getEstAdmin() == 1){
                echo "<a href='indexx.php?action=home&controller=ControllerUtilisateur'>Page administrateur</a>";
            }
            echo "<a href='indexx.php?action=deconnexion&controller=ControllerUtilisateur'>Deconnexion</a>";
            echo "<a href='indexx.php?action=formModifierCompte&controller=ControllerUtilisateur'> Modifier mon compte</a>";
            echo "<a href='indexx.php?action=readAll&controller=ControllerCommande'> Mes commandes</a>";
        }

        if (!isset($_SESSION['utilisateur'])) {
            echo "<a href='indexx.php?action=formConnexion&controller=ControllerUtilisateur'>Se connecter</a>";
            echo "<a href='indexx.php?action=formCreationCompte&controller=ControllerUtilisateur'>Créer un compte</a>";
        }

        echo "<a href='indexx.php?action=voirPanier&controller=ControllerPanier'>Mon panier</a>";
        ?>
    </div>

    <div class="nom_site">~ Nos good goods ~</div>

    <div class="categories">
        <a href='indexx.php?'>Tout</a>
        <?php
        $tab_categorie = ModelProduit::getAllCategories();
        foreach ($tab_categorie as $categorie) {
            $categorie = $categorie['nomCategorie'];
            echo "<a href='indexx.php?action=readAll&controller=ControllerProduit&action=readAll&categorie=$categorie'> $categorie </a>";
        }
        ?>
    </div>

</header>

<body>
<?php
$filepath = File::build_path(array("view", "$view.php"));
require $filepath;
?>
</body>

<footer>
    <p>
        Site de Yvang et Djulie
    </p>
</footer>

</html>