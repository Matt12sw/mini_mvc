<h2>Votre panier</h2>

<?php if (!empty($items)) : ?>
    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Prix</th>
                <th>Qté</th>
                <th>Total</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item) : ?>
                <?php $p = $item['product']; ?>
                <tr>
                    <td><?= htmlspecialchars((string) $p['nom']) ?></td>
                    <td><?= htmlspecialchars((string) $p['prix_']) ?> €</td>
                    <td><?= htmlspecialchars((string) $item['qty']) ?></td>
                    <td><?= htmlspecialchars((string) number_format((float) $item['line_total'], 2, '.', '')) ?> €</td>
                    <td>
                        <a href="<?= htmlspecialchars((string) $baseUrl) ?>/panier/supprimer/<?= urlencode((string) $p['id_produit_']) ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p><strong>Total :</strong> <?= htmlspecialchars((string) number_format((float) $total, 2, '.', '')) ?> €</p>

    <p>
        <a href="<?= htmlspecialchars((string) $baseUrl) ?>/panier/vider">Vider le panier</a>
    </p>

    <?php if (empty($_SESSION['client_id'])) : ?>
        <p>
            Pour valider la commande, connectez-vous :
            <a href="<?= htmlspecialchars((string) $baseUrl) ?>/connexion">Connexion</a>
        </p>
    <?php else : ?>
        <form method="post" action="<?= htmlspecialchars((string) $baseUrl) ?>/commande/valider">
            <p>
                <label>Adresse de livraison</label><br>
                <input type="text" name="adresse_livraison" value="<?= htmlspecialchars((string) (($client['adresse'] ?? '') ?: '')) ?>" style="width: 320px;">
            </p>
            <button type="submit">Valider la commande</button>
        </form>
    <?php endif; ?>
<?php else : ?>
    <p>Votre panier est vide.</p>
<?php endif; ?>
