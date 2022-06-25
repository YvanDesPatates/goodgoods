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

Demandé par le prof:
- transformer le panier en commande -> la classe ModelCommande est testé et devrait être complète, manque plus que ControllerCommande et les vues readAll et détail
- mettre la TVA
- afficher les commandes (en pdf si possible)
- un site fonctionnel





Pour Juju à mettre dans la bdd :

CREATE TABLE `lignesCommande` (
`idProduit` int(11) NOT NULL,
`idCommande` int(11) NOT NULL,
`quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `Commandes` (
`idCommande` int(11) NOT NULL,
`date` date DEFAULT NULL,
`mailUtilisateur` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `lignesCommande`
ADD PRIMARY KEY (`idProduit`,`idCommande`),
ADD KEY `fk_idCommande` (`idCommande`);

ALTER TABLE `Commandes`
ADD PRIMARY KEY (`idCommande`),
ADD KEY `fk_mailUtilisateur` (`mailUtilisateur`);

ALTER TABLE `Commandes`
MODIFY `idCommande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

ALTER TABLE `lignesCommande`
ADD CONSTRAINT `fk_idCommande` FOREIGN KEY (`idCommande`) REFERENCES `Commandes` (`idCommande`),
ADD CONSTRAINT `fk_idProduit_commande` FOREIGN KEY (`idProduit`) REFERENCES `produits` (`idProduit`);

ALTER TABLE `Commandes`
ADD CONSTRAINT `fk_mailUtilisateur_commandes` FOREIGN KEY (`mailUtilisateur`) REFERENCES `utilisateurs` (`mail`);
