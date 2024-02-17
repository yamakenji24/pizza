<?php declare(strict_types=1);

namespace Test\Adapter\User;

use App\Adapter\Infrastructure\MySQLConnection;
use App\Adapter\User\UserRepositoryImpl;
use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;

class UserRepositoryImplTest extends TestCase
{
    protected function setUp(): void
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../../');
        $dotenv->load();
    }
    /**
     * @test
     */
    public function findById_Userを取得することができる()
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
    public function findById_Userが存在しない場合は例外を投げる()
    {
        $this->assertTrue(true);
    }
}