<?php

declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\Client;
use Mini\Models\Commande;

final class AccountController extends Controller
{
    public function orders(): void
    {
        if (empty($_SESSION['client_id'])) {
            $this->redirect('/connexion');
        }

        $clientId = (int) $_SESSION['client_id'];
        $client = Client::findById($clientId);
        if ($client === null) {
            unset($_SESSION['client_id']);
            $this->redirect('/connexion');
        }

        $orders = Commande::getByClient($clientId);

        $this->render('account/orders', params: [
            'title' => 'Mes commandes',
            'client' => $client,
            'orders' => $orders,
        ]);
    }
}
