<h2>Inscription</h2>

<?php if (!empty($error)) : ?>
    <p style="color: red;">
        <?= htmlspecialchars((string) $error) ?>
    </p>
<?php endif; ?>

<form method="post" action="<?= htmlspecialchars((string) $baseUrl) ?>/inscription">
    <p>
        <label>Nom</label><br>
        <input type="text" name="nom" required>
    </p>
    <p>
        <label>Email</label><br>
        <input type="email" name="email" required>
    </p>
    <p>
        <label>Mot de passe</label><br>
        <input type="password" name="password" required>
    </p>
    <p>
        <label>Adresse</label><br>
        <input type="text" name="adresse" required style="width: 320px;">
    </p>
    <button type="submit">Créer le compte</button>
</form>

<p>
    Déjà un compte ? <a href="<?= htmlspecialchars((string) $baseUrl) ?>/connexion">Connexion</a>
</p>
