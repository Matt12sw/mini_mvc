<?php

declare(strict_types=1);

namespace Mini\Models;

use Mini\Core\Database;
use PDO;

final class Produit
{
    /**
     * @return array<int, array<string, mixed>>
     */
    public static function getAll(): array
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->query('SELECT * FROM Produit ORDER BY id_produit_ DESC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param array<int, int> $ids
     * @return array<int, array<string, mixed>>
     */
    public static function getByIds(array $ids): array
    {
        $ids = array_values(array_filter(array_map('intval', $ids), fn ($v) => $v > 0));
        if ($ids === []) {
            return [];
        }

        $pdo = Database::getPDO();
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $stmt = $pdo->prepare('SELECT * FROM Produit WHERE id_produit_ IN (' . $placeholders . ')');
        $stmt->execute($ids);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public static function getByCategorie(int $categoryId): array
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare('SELECT * FROM Produit WHERE id_categorie = ? ORDER BY nom ASC');
        $stmt->execute([$categoryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return array<string, mixed>|null
     */
    public static function findById(int $id): ?array
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare('SELECT p.*, c.nom AS categorie_nom FROM Produit p LEFT JOIN Categorie c ON c.id_categorie = p.id_categorie WHERE p.id_produit_ = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row === false ? null : $row;
    }
}
