
INSERT INTO Categorie (id_categorie, description, image, nom, created_at, updated_at) VALUES
(1, 'Informatique et accessoires', 'informatique.jpg', 'Informatique', NOW(), NOW()),
(2, 'Vêtements et accessoires', 'mode.jpg', 'Mode', NOW(), NOW()),
(3, 'Livres et romans', 'livres.jpg', 'Livres', NOW(), NOW()),
(4, 'Articles pour la maison', 'maison.jpg', 'Maison', NOW(), NOW()),
(5, 'Jeux vidéo et consoles', 'jeux.jpg', 'Jeux Vidéo', NOW(), NOW());


INSERT INTO Produit (id_produit_, nom, prix_, image, description_, stock, updated_at, create_at, id_categorie) VALUES
-- Catégorie 1 : Informatique
(1, 'Clavier mécanique', 79.99, 'clavier.jpg', 'Clavier RGB haute performance', 50, NOW(), NOW(), 1),
(2, 'Souris gaming', 49.90, 'souris.jpg', 'Souris ergonomique 7200 DPI', 100, NOW(), NOW(), 1),
(3, 'Écran 27 pouces', 189.00, 'ecran.jpg', 'Écran IPS Full HD', 30, NOW(), NOW(), 1),
(4, 'Casque USB', 39.90, 'casque.jpg', 'Casque avec micro antibruit', 80, NOW(), NOW(), 1),
(5, 'Webcam HD', 59.90, 'webcam.jpg', 'Webcam 1080p 60 fps', 40, NOW(), NOW(), 1),

-- Catégorie 2 : Mode
(6, 'T-shirt coton', 14.99, 'tshirt.jpg', 'T-shirt 100% coton', 200, NOW(), NOW(), 2),
(7, 'Jean slim', 39.90, 'jean.jpg', 'Jean coupe moderne', 120, NOW(), NOW(), 2),
(8, 'Sweat capuche', 29.90, 'sweat.jpg', 'Sweat confortable', 150, NOW(), NOW(), 2),
(9, 'Chaussures sport', 69.90, 'chaussure.jpg', 'Chaussures de running', 90, NOW(), NOW(), 2),
(10, 'Veste en cuir', 149.90, 'veste.jpg', 'Veste tendance', 25, NOW(), NOW(), 2),

-- Catégorie 3 : Livres
(11, 'Roman fantastique', 19.90, 'fantasy.jpg', 'Livre de fantasy', 100, NOW(), NOW(), 3),
(12, 'BD aventure', 12.50, 'bd.jpg', 'Bande dessinée', 70, NOW(), NOW(), 3),
(13, 'Livre cuisine', 24.90, 'cuisine.jpg', 'Recettes faciles', 50, NOW(), NOW(), 3),
(14, 'Thriller', 17.50, 'thriller.jpg', 'Roman suspense', 85, NOW(), NOW(), 3),
(15, 'Science-fiction', 21.00, 'sf.jpg', 'Roman futuriste', 60, NOW(), NOW(), 3),

-- Catégorie 4 : Maison
(16, 'Lampe LED', 29.99, 'lampe.jpg', 'Lampe tactile', 150, NOW(), NOW(), 4),
(17, 'Coussin déco', 12.90, 'coussin.jpg', 'Coussin confortable', 200, NOW(), NOW(), 4),
(18, 'Plaid doux', 19.90, 'plaid.jpg', 'Plaid chaleureux', 120, NOW(), NOW(), 4),
(19, 'Tapis salon', 89.90, 'tapis.jpg', 'Tapis moderne', 40, NOW(), NOW(), 4),
(20, 'Bougie parfumée', 7.90, 'bougie.jpg', 'Bougie vanille', 300, NOW(), NOW(), 4),

-- Catégorie 5 : Jeux Vidéo
(21, 'Manette PS5', 69.90, 'manette.jpg', 'Manette sans fil', 80, NOW(), NOW(), 5),
(22, 'Jeu action', 59.90, 'jeu_action.jpg', 'Jeu vidéo d’action', 100, NOW(), NOW(), 5),
(23, 'Clavier gaming', 129.90, 'clavier_gaming.jpg', 'Clavier mécanique RGB', 50, NOW(), NOW(), 5),
(24, 'Casque gaming', 89.90, 'casque_gaming.jpg', 'Casque surround 7.1', 70, NOW(), NOW(), 5),
(25, 'Console portable', 299.90, 'console.jpg', 'Console de jeu portable', 20, NOW(), NOW(), 5);


INSERT INTO Client (id_client_, nom_, email, passsword_, adresse, created_at) VALUES
(1, 'Alice Dupont', 'alice@mail.com', 'mdp123', '12 rue des Fleurs', NOW()),
(2, 'Bob Martin', 'bob@mail.com', 'mdp123', '5 rue Verte', NOW()),
(3, 'Claire Durand', 'claire@mail.com', 'mdp123', '9 avenue Paris', NOW()),
(4, 'David Leroy', 'david@mail.com', 'mdp123', '2 rue Bleue', NOW()),
(5, 'Emma Rossi', 'emma@mail.com', 'mdp123', '14 rue Soleil', NOW());


INSERT INTO Commande (id_commande_, statut, montant_total, created_at, adresse_livraison) VALUES
(1, 'payée', 199.70, NOW(), '12 rue des Fleurs'),
(2, 'expédiée', 89.90, NOW(), '5 rue Verte'),
(3, 'payée', 149.80, NOW(), '9 avenue Paris'),
(4, 'en préparation', 59.90, NOW(), '2 rue Bleue'),
(5, 'payée', 279.80, NOW(), '14 rue Soleil'),
(6, 'expédiée', 119.80, NOW(), '12 rue des Fleurs'),
(7, 'payée', 39.90, NOW(), '5 rue Verte'),
(8, 'livrée', 129.90, NOW(), '9 avenue Paris'),
(9, 'payée', 99.90, NOW(), '2 rue Bleue'),
(10, 'expédiée', 159.90, NOW(), '14 rue Soleil');

INSERT INTO PASSER (id_commande_, id_client_) VALUES
(1, 1), (2, 2), (3, 3), (4, 4), (5, 5),
(6, 1), (7, 2), (8, 3), (9, 4), (10, 5);


INSERT INTO INCLURE (id_produit_, id_commande_) VALUES
(1, 1), (4, 1), (5, 1),
(7, 2), (8, 2),
(11, 3), (14, 3),
(16, 4), (20, 4),
(21, 5), (22, 5), (23, 5),
(2, 6), (3, 6),
(6, 7),
(13, 8), (15, 8), (12, 8),
(18, 9), (19, 9),
(24, 10), (25, 10);
