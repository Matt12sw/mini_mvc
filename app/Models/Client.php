<?php

declare(strict_types=1);

namespace Mini\Models;

use Mini\Core\Database;
use PDO;

final class Client
{
    /**
     * @return array<string, mixed>|null
     */
    public static function findById(int $id): ?array
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare('SELECT * FROM Client WHERE id_client_ = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row === false ? null : $row;
    }

    /**
     * @return array<string, mixed>|null
     */
    public static function findByEmail(string $email): ?array
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare('SELECT * FROM Client WHERE email = ?');
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row === false ? null : $row;
    }

    public static function nextId(): int
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->query('SELECT COALESCE(MAX(id_client_), 0) + 1 AS next_id FROM Client');
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int) ($row['next_id'] ?? 1);
    }

    public static function create(string $nom, string $email, string $passwordHash, string $adresse): int
    {
        $pdo = Database::getPDO();
        $id = self::nextId();

        $stmt = $pdo->prepare('INSERT INTO Client (id_client_, nom_, email, passsword_, adresse, created_at) VALUES (?, ?, ?, ?, ?, NOW())');
        $stmt->execute([$id, $nom, $email, $passwordHash, $adresse]);

        return $id;
    }
}
