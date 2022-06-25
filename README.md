# goodgoods

Site commercial de biens en provenance des vilains dans les dessins animés:

A noter :
- utilisation de GET dans routeur : toujours passer les arguments DANS L'ORDRE demandé par la fonction !
- classe panier : 
        - tableau lignepanier indexé par idproduit et associé à une quantité
        - panier : update de la base de donnée à chaque ajout/retrait panier
        - update de la date panier quand on fait appel à ajoutPanier() alors que le panier est vide
- session() : 
    organisation session : $_SESSION['utilisateur'] et $_SESSION['panier'] distinct
    si non connecté :
        - $_SESSION['utilisateur'] n'existe pas
        - $_SESSION['panier'] corresponds à un panier temporaire 
    dès la connexion, $_SESSION['panier'] doit correspondre au panier lié à l'utilisateur dans la base de données
    



A faire :
- cookies ?
- securité des vues (voir TD5)
- hachage mdp
- authentification et validation par email

BDD sous Mysql : Le script goodgoods.sql permet de créer les tables et ajoutes quelques tuples exemples.

Pour changer les accèes à la base de donnée : Configuration.php
