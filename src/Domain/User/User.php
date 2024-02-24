<?php declare(strict_types=1);

namespace App\Domain\User;

class User
{
    public function __construct(
        private int $id,
        private string $username,
        private string $hashed_password,
        private string $email,
        private string $bio,
        private string $image
    )
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getBio(): string
    {
        return $this->bio;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function verify(string $password): bool
    {
        return password_verify($password, $this->hashed_password);
    }
}