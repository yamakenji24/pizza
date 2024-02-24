<?php

namespace App\Domain\Token;

class AuthenticateUser
{
    public function __construct(private string $email, private string $hashed_password)
    {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getHashedPassword(): string
    {
        return $this->hashed_password;
    }
}