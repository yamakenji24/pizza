<?php

namespace Test\Adapter\User;

use App\Adapter\Infrastructure\MySQLConnection;
use App\Adapter\User\AuthenticateUserRepositoryImpl;
use PHPUnit\Framework\TestCase;

class AuthenticateUserRepositoryImplTest extends TestCase
{
    /**
     * @test
     */
    public function findByEmail_ユーザーを取得することができる(): void
    {
        $email = 'sample_user@pizza.com';
        $connection = new MySQLConnection();
        $repository = new AuthenticateUserRepositoryImpl($connection);

        $user = $repository->findByEmail($email);

        $this->assertNotNull($user);
        $this->assertEquals($email, $user->getEmail());
    }

    /**
     * @test
     */
    public function findByEmail_ユーザーが存在しない場合は例外を投げる(): void
    {
        $email = 'invalid_user@pizza.com';
        $connection = new MySQLConnection();
        $repository = new AuthenticateUserRepositoryImpl($connection);

        $this->expectException(\Exception::class);

        $repository->findByEmail($email);
    }
}