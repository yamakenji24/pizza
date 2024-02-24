<?php declare(strict_types=1);

namespace App\Domain\User;

interface UserRepository
{
    public function findById(int $account_id): ?User;

    public function findByEmail(string $email): ?User;

}