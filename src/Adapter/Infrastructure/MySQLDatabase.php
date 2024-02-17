<?php declare(strict_types=1);

namespace App\Adapter\Infrastructure;

use PDO;

class MySQLDatabase
{
    private ?PDO $pdo = null;

    public function __construct()
    {
        $host = 'pizza-mysql';
        $db = getenv('MYSQL_DATABASE');
        $charset = 'utf8mb4';
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        if ($this->pdo === null) {
            $user = getenv('MYSQL_USER');
            $pass = getenv('MYSQL_PASSWORD');
            $this->pdo = new PDO($dsn, (string) $user, (string) $pass);
        }
    }

    public function query(string $sql, mixed $params = []): mixed
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function execute(string $sql, mixed $params = []): bool
    {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }
}