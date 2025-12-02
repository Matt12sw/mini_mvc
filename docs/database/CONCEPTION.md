### Questions de réflexion

Répondez à ces questions dans un document `CONCEPTION.md` :

1. **Pourquoi stocker le prix unitaire dans la table des lignes de commande plutôt que d'utiliser directement le prix du produit ?**

Le prix d’un produit peut changer

Un produit peut voir son prix augmenter ou baisser dans le futur.
Si on utilisait simplement le prix actuel dans la table Produit :

Toutes les anciennes commandes auraient un prix faux.

Une commande doit représenter une photo exacte au moment de l’achat

Une ligne de commande doit conserver l’historique :

prix unitaire au moment du paiement

quantité

sous-total

Donc on met prix_unitaire dans LigneCommande pour préserver l’intégrité et l’historique commercial.

2. **Quelle stratégie avez-vous choisie pour gérer les suppressions ?**
Justifiez vos choix pour chaque relation.
    - Cascade (ON DELETE CASCADE)
    - Restriction (ON DELETE RESTRICT)
    - Mise à NULL (ON DELETE SET NULL)
    - Soft delete (champ deleted_at)
 
**1 Catégorie → Produit**
ON DELETE RESTRICT
Justification :
On ne veut pas supprimer une catégorie si elle contient encore des produits.
Cela évite des produits “orphelins”.

**2 Produit → LigneCommande**
ON DELETE RESTRICT
Justification :
Une ligne de commande doit refléter un achat passé.
Un produit ne peut pas être supprimé s’il est dans une commande.
Sinon, on perdrait l’historique.

**3 Client → Commande**
Relation gérée via la table PASSER.
ON DELETE RESTRICT
Justification :
On ne supprime jamais un client ayant des commandes historiques.
Règle comptable classique.

**4 Commande → LigneCommande**
ON DELETE CASCADE
Justification :
Si on supprime une commande (rare), ses lignes doivent disparaître.
Cela évite les lignes orphelines.

**5 Administrateur**
Pas de relation.
→ Pas de stratégie particulière.


3. **Comment gérez-vous les stocks ?**
    - Que se passe-t-il si un client commande un produit en rupture de stock ?
    - Quand le stock est-il décrémenté (panier, validation, paiement) ?

Le stock est décrémenté au moment de la validation de la commande
Pas au panier (car panier = temporaire).
Pas au paiement (risque de conflits).

Workflow :

Le client valide sa commande.

Le système vérifie les quantités disponibles.

Si stock insuffisant → erreur.

Sinon → décrémentation immédiate.


Si un client commande un produit en rupture de stock
→ La commande est refusée.
→ Le client doit modifier sa commande.

4. **Avez-vous prévu des index ?** Lesquels et pourquoi ?

Clés primaires → index automatique
Index utiles ajoutés :

email sur Client (UNIQUE)

username et email sur Administrateur (UNIQUE)

id_categorie sur Produit (index FK)

id_client et id_commande dans PASSER

id_commande et id_produit dans INCLURE

Justification :

Accélère les SELECT et JOIN, surtout sur produits et commandes

Obligatoire pour optimiser le e-commerce


5. **Comment assurez-vous l'unicité du numéro de commande ?**
Nous utilisons :

id_commande en PRIMARY KEY

Ce champ peut être généré automatiquement en AUTO_INCREMENT

Optionnellement, on peut générer un numéro stylé (ex : CMD202400123)

Pour le TP, l’unicité est assurée par :

la clé primaire
la base de données


6. **Quelles sont les extensions possibles de votre modèle ?**
    - Gestion de plusieurs adresses par client
    - Historique des prix
    - Avis clients
    - Images multiples par produit
    - etc.


1. Gestion de plusieurs adresses par client
2. Historique des prix
3. Avis clients
4. Plusieurs images par produit
5. Wishlist / Favoris
6. Suivi des commandes (tracking)