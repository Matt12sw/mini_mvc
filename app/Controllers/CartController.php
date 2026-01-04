<?php

declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\Client;
use Mini\Models\Produit;

final class CartController extends Controller
{
    public function index(): void
    {
        $cart = $_SESSION['cart'] ?? [];
        if (!is_array($cart)) {
            $cart = [];
        }

        $productIds = array_keys($cart);
        $products = Produit::getByIds(array_map('intval', $productIds));

        $productsById = [];
        foreach ($products as $p) {
            $productsById[(int) $p['id_produit_']] = $p;
        }

        $items = [];
        $total = 0.0;

        foreach ($cart as $productId => $qty) {
            $pid = (int) $productId;
            $qty = (int) $qty;
            if ($qty <= 0 || empty($productsById[$pid])) {
                continue;
            }

            $price = (float) ($productsById[$pid]['prix_'] ?? 0);
            $lineTotal = $price * $qty;
            $total += $lineTotal;

            $items[] = [
                'product' => $productsById[$pid],
                'qty' => $qty,
                'line_total' => $lineTotal,
            ];
        }

        $client = null;
        if (!empty($_SESSION['client_id'])) {
            $client = Client::findById((int) $_SESSION['client_id']);
        }

        $this->render('cart/index', params: [
            'title' => 'Panier',
            'items' => $items,
            'total' => $total,
            'client' => $client,
        ]);
    }

    public function add(string $id): void
    {
        $productId = (int) $id;
        if ($productId <= 0) {
            $this->redirect('/panier');
        }

        if (empty($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $_SESSION['cart'][$productId] = (int) ($_SESSION['cart'][$productId] ?? 0) + 1;
        $this->redirect('/panier');
    }

    public function remove(string $id): void
    {
        $productId = (int) $id;
        if (!empty($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            unset($_SESSION['cart'][$productId]);
        }

        $this->redirect('/panier');
    }

    public function clear(): void
    {
        $_SESSION['cart'] = [];
        $this->redirect('/panier');
    }
}
