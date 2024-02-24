<?php declare(strict_types=1);

namespace App\Domain\Token;

interface AuthenticateUserRepository
{
    public function findByEmail(string $email): AuthenticateUser;
}