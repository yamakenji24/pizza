<?php declare(strict_types=1);

namespace App\Application\Users;

use App\Adapter\Utility\TokenRepository;
use App\Domain\User\InvalidUserAuthenticateException;
use App\Domain\User\UserRepository;

class PostLoginUserUseCase
{
    public function __construct(private readonly UserRepository $repository, private readonly TokenRepository $tokenRepository)
    {
    }

    /**
     * @throws InvalidUserAuthenticateException
     * @return array{
     *  email: string,
     *  token: string,
     *  username: string,
     *  bio: string|null,
     *  image: string|null
     * }
     */
    public function execute(string $email, string $password)
    {
        $user = $this->repository->findByEmail($email);

        if (!$user->verify($password)) {
            throw new InvalidUserAuthenticateException();
        }
        $token = $this->tokenRepository->generateToken($user->getId());

        return [
            'email' => $user->getEmail(),
            'token' => $token,
            'username' => $user->getUsername(),
            'bio' => $user->getBio(),
            'image' => $user->getImage(),
        ];
    }
}