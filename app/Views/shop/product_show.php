<p>
    <a href="<?= htmlspecialchars((string) $baseUrl) ?>/categorie/<?= urlencode((string) ($product['id_categorie'] ?? '')) ?>">Retour à la catégorie</a>
</p>

<h2><?= htmlspecialchars((string) ($product['nom'] ?? '')) ?></h2>

<p><strong>Catégorie :</strong> <?= htmlspecialchars((string) ($product['categorie_nom'] ?? '')) ?></p>
<p><strong>Prix :</strong> <?= htmlspecialchars((string) ($product['prix_'] ?? '')) ?> €</p>
<p><strong>Stock :</strong> <?= htmlspecialchars((string) ($product['stock'] ?? '')) ?></p>

<p>
    <a href="<?= htmlspecialchars((string) $baseUrl) ?>/panier/ajouter/<?= urlencode((string) ($product['id_produit_'] ?? '')) ?>">Ajouter au panier</a>
</p>

<?php if (!empty($product['description_'])) : ?>
    <p><?= nl2br(htmlspecialchars((string) $product['description_'])) ?></p>
<?php endif; ?>
