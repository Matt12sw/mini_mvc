<p>
    <a href="<?= htmlspecialchars((string) $baseUrl) ?>/catalogue">Retour aux catégories</a>
</p>

<h2>Produits - <?= htmlspecialchars((string) ($category['nom'] ?? '')) ?></h2>

<?php if (!empty($products)) : ?>
    <div class="grid">
        <?php foreach ($products as $p) : ?>
            <div class="card">
                <div class="card__title">
                    <?= htmlspecialchars((string) $p['nom']) ?>
                </div>
                <div class="card__meta">
                    <span class="badge"><?= htmlspecialchars((string) $p['prix_']) ?> €</span>
                    <span class="badge">Stock: <?= htmlspecialchars((string) $p['stock']) ?></span>
                </div>
                <div class="card__actions">
                    <a class="btn" href="<?= htmlspecialchars((string) $baseUrl) ?>/produit/<?= urlencode((string) $p['id_produit_']) ?>">Voir</a>
                    <a class="btn btn-primary" href="<?= htmlspecialchars((string) $baseUrl) ?>/panier/ajouter/<?= urlencode((string) $p['id_produit_']) ?>">Ajouter</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <p>Aucun produit dans cette catégorie.</p>
<?php endif; ?>
