<h2>Commande validée</h2>

<p>Votre commande n° <?= htmlspecialchars((string) $orderId) ?> a bien été enregistrée.</p>
<p>Total : <?= htmlspecialchars((string) number_format((float) $total, 2, '.', '')) ?> €</p>

<p>
    <a href="<?= htmlspecialchars((string) $baseUrl) ?>/">Retour à l'accueil</a>
</p>
