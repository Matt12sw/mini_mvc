<?php

declare(strict_types=1);

namespace Mini\Models;

use Mini\Core\Database;
use PDO;

final class Categorie
{
    /**
     * @return array<int, array<string, mixed>>
     */
    public static function getAll(): array
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->query('SELECT * FROM Categorie ORDER BY nom ASC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return array<string, mixed>|null
     */
    public static function findById(int $id): ?array
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare('SELECT * FROM Categorie WHERE id_categorie = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row === false ? null : $row;
    }
}
