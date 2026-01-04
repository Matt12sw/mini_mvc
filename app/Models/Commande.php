<?php

declare(strict_types=1);

namespace Mini\Models;

use Mini\Core\Database;
use PDO;

final class Commande
{
    public static function nextId(): int
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->query('SELECT COALESCE(MAX(id_commande_), 0) + 1 AS next_id FROM Commande');
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int) ($row['next_id'] ?? 1);
    }

    public static function create(int $clientId, string $statut, float $montantTotal, string $adresseLivraison): int
    {
        $pdo = Database::getPDO();
        $idCommande = self::nextId();

        $stmt = $pdo->prepare('INSERT INTO Commande (id_commande_, statut, montant_total, created_at, adresse_livraison) VALUES (?, ?, ?, NOW(), ?)');
        $stmt->execute([$idCommande, $statut, $montantTotal, $adresseLivraison]);

        $stmt2 = $pdo->prepare('INSERT INTO PASSER (id_commande_, id_client_) VALUES (?, ?)');
        $stmt2->execute([$idCommande, $clientId]);

        return $idCommande;
    }

    /**
     * @param array<int, int> $productIds
     */
    public static function addProducts(int $orderId, array $productIds): void
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare('INSERT INTO INCLURE (id_produit_, id_commande_) VALUES (?, ?)');

        foreach ($productIds as $pid) {
            $stmt->execute([(int) $pid, $orderId]);
        }
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public static function getByClient(int $clientId): array
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare('SELECT c.* FROM Commande c JOIN PASSER p ON p.id_commande_ = c.id_commande_ WHERE p.id_client_ = ? ORDER BY c.created_at DESC');
        $stmt->execute([$clientId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
