<?php declare(strict_types=1);

namespace Test\Domain\User;

use App\Domain\User\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function verify_パスワードが正しい場合はtrueを返す(): void
    {
        $hashed_password = '$2y$10$PZrg2Ix78VtRNqFC73x0jeUxhMW.aXgGCjesP3ts0KTaJESO1ksi6';
        $user = new User(
            1,
            'sample_user',
            $hashed_password,
            'sample_user@pizza.com',
            '',
            ''
        );

        $this->assertTrue($user->verify('pizza_password'));
    }

    /**
     * @test
     */
    public function verify_パスワードが正しくない場合はfalseを返す(): void
    {
        $hashed_password = '$2y$10$PZrg2Ix78VtRNqFC73x0jeUxhMW.aXgGCjesP3ts0KTaJESO1ksi6';
        $user = new User(
            1,
            'sample_user',
            $hashed_password,
            '',
            '',
            ''
        );

        $this->assertFalse($user->verify('invalid_password'));
    }
}