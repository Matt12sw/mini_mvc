UNIQUE(email)
);

CREATE TABLE Commande(
   id_commande_ INT,
   statut VARCHAR(20) NOT NULL,
   montant_total DECIMAL(15,2) NOT NULL,
   created_at DATETIME NOT NULL,
   adresse_livraison VARCHAR(255) NOT NULL,
   PRIMARY KEY(id_commande_)
);

CREATE TABLE Client(
   id_client_ INT,
   nom_ VARCHAR(150) NOT NULL,
   email VARCHAR(150) NOT NULL,
   passsword_ VARCHAR(255) NOT NULL,
   adresse VARCHAR(255) NOT NULL,
   created_at DATETIME NOT NULL,
   PRIMARY KEY(id_client_),
   UNIQUE(email)
);

CREATE TABLE PASSER(
   id_commande_ INT,
   id_client_ INT,
   PRIMARY KEY(id_commande_, id_client_),
   FOREIGN KEY(id_commande_) REFERENCES Commande(id_commande_),
   FOREIGN KEY(id_client_) REFERENCES Client(id_client_)
);

CREATE TABLE INCLURE(
   id_produit_ INT,
   id_commande_ INT,
   PRIMARY KEY(id_produit_, id_commande_),
   FOREIGN KEY(id_produit_) REFERENCES Produit(id_produit_),
   FOREIGN KEY(id_commande_) REFERENCES Commande(id_commande_)
);
