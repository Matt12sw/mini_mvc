<!doctype html>
<!-- Définit la langue du document -->
<html lang="fr">
<!-- En-tête du document HTML -->
<head>
    <!-- Déclare l'encodage des caractères -->
    <meta charset="utf-8">
    <!-- Configure le viewport pour les appareils mobiles -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Définit le titre de la page avec échappement -->
    <title><?= isset($title) ? htmlspecialchars($title) : 'App' ?></title>
    <link rel="stylesheet" href="<?= htmlspecialchars((string) ($baseUrl ?? '')) ?>/assets/style.css">
</head>
<!-- Corps du document -->
<body>
<!-- En-tête de la page -->
<header>
    <!-- Affiche le titre principal avec échappement -->
    <h1><?= isset($title) ? htmlspecialchars($title) : 'App' ?></h1>

    <nav>
        <a href="<?= htmlspecialchars((string) ($baseUrl ?? '')) ?>/">Accueil</a>
        |
        <a href="<?= htmlspecialchars((string) ($baseUrl ?? '')) ?>/catalogue">Catalogue</a>
        |
        <a href="<?= htmlspecialchars((string) ($baseUrl ?? '')) ?>/panier">Panier (<?= htmlspecialchars((string) (array_sum($_SESSION['cart'] ?? []) ?: 0)) ?>)</a>
        |
        <?php if (!empty($_SESSION['client_id'])) : ?>
            <a href="<?= htmlspecialchars((string) ($baseUrl ?? '')) ?>/mes-commandes">Mes commandes</a>
            |
            <a href="<?= htmlspecialchars((string) ($baseUrl ?? '')) ?>/deconnexion">Déconnexion</a>
        <?php else : ?>
            <a href="<?= htmlspecialchars((string) ($baseUrl ?? '')) ?>/connexion">Connexion</a>
            |
            <a href="<?= htmlspecialchars((string) ($baseUrl ?? '')) ?>/inscription">Inscription</a>
        <?php endif; ?>
    </nav>
</header>
<!-- Zone de contenu principal -->
<main>
    <!-- Insère le contenu rendu de la vue -->
    <?= $content ?>
    
</main>
<!-- Fin du corps de la page -->
</body>
<!-- Fin du document HTML -->
</html>

