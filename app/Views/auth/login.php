<h2>Connexion</h2>

<?php if (!empty($error)) : ?>
    <p style="color: red;">
        <?= htmlspecialchars((string) $error) ?>
    </p>
<?php endif; ?>

<form method="post" action="<?= htmlspecialchars((string) $baseUrl) ?>/connexion">
    <p>
        <label>Email</label><br>
        <input type="email" name="email" required>
    </p>
    <p>
        <label>Mot de passe</label><br>
        <input type="password" name="password" required>
    </p>
    <button type="submit">Se connecter</button>
</form>

<p>
    Pas de compte ? <a href="<?= htmlspecialchars((string) $baseUrl) ?>/inscription">Inscription</a>
</p>
