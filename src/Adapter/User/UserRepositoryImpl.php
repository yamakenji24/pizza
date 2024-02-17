<?php declare(strict_types=1);

namespace App\Adapter\User;

use App\Adapter\Infrastructure\MySQLConnection;
use App\Adapter\Infrastructure\MySQLDatabase;
use App\Domain\User\User;
use App\Domain\User\UserRepository;

class UserRepositoryImpl implements UserRepository
{
    private MySQLDatabase $db;

    public function __construct(MySQLConnection $connection)
    {
        $this->db = $connection->getConnection();
    }

    public function findById(int $account_id): ?User
    {
        $sql = 'SELECT a.id, a.email, a_p.username, a_p.bio, a_p.image 
                FROM account a
                LEFT JOIN account_profile a_p ON a.id = a_p.account_id 
                WHERE a.id = :id';
        $params = ['id' => $account_id];
        $result = $this->db->query($sql, $params);

        if (empty($result)) {
            return null;
        }
        
        $account = $result[0];
        return new User(
            $account['id'],
            $account['username'],
            $account['email'],
            $account['bio'],
            $account['image']
        );
    }
}