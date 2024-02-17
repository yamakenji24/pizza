<?php declare(strict_types=1);

namespace App\Application\User;

use App\Domain\User\User;
use App\Domain\User\UserRepository;

class GetCurrentUserUseCase
{
    public function __construct(private UserRepository $repository)
    {
    }

    public function execute(int $account_id): User
    {
        try {
            $account = $this->repository->findById($account_id);
            return $account;
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}