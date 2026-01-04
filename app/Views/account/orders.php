<h2>Mes commandes</h2>

<p>
    Connecté : <?= htmlspecialchars((string) ($client['nom_'] ?? '')) ?> (<?= htmlspecialchars((string) ($client['email'] ?? '')) ?>)
</p>

<?php if (!empty($orders)) : ?>
    <div class="orders">
        <?php foreach ($orders as $o) : ?>
            <div class="order-card">
                <div class="order-card__header">
                    <div><strong>Commande #<?= htmlspecialchars((string) $o['id_commande_']) ?></strong></div>
                    <div class="order-card__status"><?= htmlspecialchars((string) ($o['statut'] ?? '')) ?></div>
                </div>

                <div class="order-card__body">
                    <div><strong>Date :</strong> <?= htmlspecialchars((string) ($o['created_at'] ?? '')) ?></div>
                    <div><strong>Montant :</strong> <?= htmlspecialchars((string) ($o['montant_total'] ?? '')) ?> €</div>
                    <div><strong>Livraison :</strong> <?= htmlspecialchars((string) ($o['adresse_livraison'] ?? '')) ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <p>Aucune commande pour le moment.</p>
<?php endif; ?>
