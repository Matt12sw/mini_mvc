<?php

declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

use Mini\Core\Router;

session_start();

// Table des routes minimaliste
$routes = [
    ['GET', '/', [Mini\Controllers\HomeController::class, 'index']],
    ['GET', '/users', [Mini\Controllers\HomeController::class, 'users']],
    ['GET', '/catalogue', [Mini\Controllers\ShopController::class, 'categories']],
    ['GET', '/categorie/{id}', [Mini\Controllers\ShopController::class, 'productsByCategory']],
    ['GET', '/produit/{id}', [Mini\Controllers\ShopController::class, 'productShow']],

    ['GET', '/panier', [Mini\Controllers\CartController::class, 'index']],
    ['GET', '/panier/ajouter/{id}', [Mini\Controllers\CartController::class, 'add']],
    ['GET', '/panier/supprimer/{id}', [Mini\Controllers\CartController::class, 'remove']],
    ['GET', '/panier/vider', [Mini\Controllers\CartController::class, 'clear']],

    ['GET', '/inscription', [Mini\Controllers\AuthController::class, 'registerForm']],
    ['POST', '/inscription', [Mini\Controllers\AuthController::class, 'register']],
    ['GET', '/connexion', [Mini\Controllers\AuthController::class, 'loginForm']],
    ['POST', '/connexion', [Mini\Controllers\AuthController::class, 'login']],
    ['GET', '/deconnexion', [Mini\Controllers\AuthController::class, 'logout']],

    ['GET', '/mes-commandes', [Mini\Controllers\AccountController::class, 'orders']],

    ['POST', '/commande/valider', [Mini\Controllers\OrderController::class, 'checkout']],
];

// Bootstrap du router
$router = new Router($routes);
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);


