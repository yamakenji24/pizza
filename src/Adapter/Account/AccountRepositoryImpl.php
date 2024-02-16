<?php declare(strict_types=1);

namespace App\Adapter\Account;

use App\Adapter\Infrastructure\MySQLConnection;
use App\Adapter\Infrastructure\MySQLDatabase;

class AccountRepositoryImpl
{
    private MySQLDatabase $db;

    public function __construct(MySQLConnection $connection)
    {
        $this->db = $connection->getConnection();
    }

    public function findById(int $id): ?array
    {
        $result = $this->db->query('SELECT * FROM account WHERE id = :id', ['id' => $id]);
        return $result[0] ?? null;
    }

    public function put(array $account): bool
    {
        return $this->db->execute('INSERT INTO account (id, username, password) VALUES (:id, :username, :password) ON DUPLICATE KEY UPDATE username = :username', $account);
    }
}