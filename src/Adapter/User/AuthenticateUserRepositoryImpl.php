<?php declare(strict_types=1);

namespace App\Adapter\User;

use App\Adapter\Infrastructure\MySQLConnection;
use App\Adapter\Infrastructure\MySQLDatabase;
use App\Domain\Token\AuthenticateUser;
use App\Domain\Token\AuthenticateUserRepository;

class AuthenticateUserRepositoryImpl implements AuthenticateUserRepository
{
    private MySQLDatabase $db;

    public function __construct(MySQLConnection $connection)
    {
        $this->db = $connection->getConnection();
    }
    public function findByEmail(string $email): AuthenticateUser
    {
        $sql = 'SELECT email, password FROM account WHERE email = :email';
        $params = ['email' => $email];
        $result = $this->db->query($sql, $params);

        if (empty($result)) {
            throw new \Exception('User not found');
        }

        $account = $result[0];
        return new AuthenticateUser(
            $account['email'],
            $account['password']
        );
    }
}