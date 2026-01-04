<?php

declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\Client;
use Mini\Models\Commande;
use Mini\Models\Produit;

final class OrderController extends Controller
{
    public function checkout(): void
    {
        if (empty($_SESSION['client_id'])) {
            $this->redirect('/connexion');
        }

        $cart = $_SESSION['cart'] ?? [];
        if (empty($cart) || !is_array($cart)) {
            $this->redirect('/panier');
        }

        $clientId = (int) $_SESSION['client_id'];
        $client = Client::findById($clientId);
        if ($client === null) {
            unset($_SESSION['client_id']);
            $this->redirect('/connexion');
        }

        $productIds = array_keys($cart);
        $products = Produit::getByIds(array_map('intval', $productIds));

        $productsById = [];
        foreach ($products as $p) {
            $productsById[(int) $p['id_produit_']] = $p;
        }

        $total = 0.0;
        $uniqueProductIds = [];

        foreach ($cart as $productId => $qty) {
            $pid = (int) $productId;
            $qty = (int) $qty;
            if ($qty <= 0 || empty($productsById[$pid])) {
                continue;
            }

            $uniqueProductIds[] = $pid;
            $total += ((float) ($productsById[$pid]['prix_'] ?? 0)) * $qty;
        }

        $adresseLivraison = trim((string) ($_POST['adresse_livraison'] ?? ''));
        if ($adresseLivraison === '') {
            $adresseLivraison = (string) ($client['adresse'] ?? '');
        }

        if ($adresseLivraison === '') {
            $this->redirect('/panier');
        }

        // Statut simple (à ajuster selon ton TP)
        $orderId = Commande::create($clientId, 'en attente', $total, $adresseLivraison);

        // Limite du schéma actuel: INCLURE n'a pas quantité/prix.
        // On insère 1 ligne par produit unique.
        Commande::addProducts($orderId, array_values(array_unique($uniqueProductIds)));

        $_SESSION['cart'] = [];

        $this->render('order/success', params: [
            'title' => 'Commande validée',
            'orderId' => $orderId,
            'total' => $total,
        ]);
    }
}
