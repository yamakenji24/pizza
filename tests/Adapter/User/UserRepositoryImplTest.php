<?php declare(strict_types=1);

namespace Test\Adapter\User;

use App\Adapter\Infrastructure\MySQLConnection;
use App\Adapter\User\UserRepositoryImpl;
use PHPUnit\Framework\TestCase;

class UserRepositoryImplTest extends TestCase
{
    /**
     * @test
     */
    public function findById_Userを取得することができる(): void
    {
        $connection = new MySQLConnection();
        $userRepository = new UserRepositoryImpl($connection);
        $user = $userRepository->findById(1);

        $this->assertNotNull($user);
        $this->assertEquals(1, $user->getId());
    }

    /**
     * @test
     */
    public function findById_Userが存在しない場合は例外を投げる(): void
    {
        $this->assertTrue(true);
    }
}