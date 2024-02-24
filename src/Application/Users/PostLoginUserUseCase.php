<?php declare(strict_types=1);

namespace App\Application\Users;

use App\Adapter\Utility\TokenRepository;
use App\Domain\User\UserRepository;

class PostLoginUserUseCase
{
    public function __construct(private readonly UserRepository $repository, private readonly TokenRepository $tokenRepository)
    {
    }

    public function execute(string $email, string $password): string
    {
        try {
            $user = $this->repository->findByEmail($email);

            if (!$user->verify($password)) {
                throw new \Exception('Invalid password');
            }

            return $this->tokenRepository->generateToken($user->getId());
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}