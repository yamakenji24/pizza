<?php declare(strict_types=1);

namespace App\Adapter\Infrastructure;

class MySQLConnection
{
    private MySQLDatabase $db;

    public function __construct()
    {
        $this->db = new MySQLDatabase();
    }

    public function getConnection(): MySQLDatabase
    {
        return $this->db;
    }
}