<h2>Catégories</h2>

<?php if (!empty($categories)) : ?>
    <ul>
        <?php foreach ($categories as $cat) : ?>
            <li>
                <a href="<?= htmlspecialchars((string) $baseUrl) ?>/categorie/<?= urlencode((string) $cat['id_categorie']) ?>">
                    <?= htmlspecialchars((string) $cat['nom']) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>Aucune catégorie.</p>
<?php endif; ?>
