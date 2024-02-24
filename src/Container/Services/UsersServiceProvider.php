<?php declare(strict_types=1);

namespace App\Container\Services;

use App\Adapter\Infrastructure\MySQLConnection;
use App\Adapter\User\UserRepositoryImpl;
use App\Adapter\Utility\TokenRepository;
use App\Application\Users\PostLoginUserUseCase;
use App\Container\Container;
use App\Controller\Users\PostLoginUserController;
use App\Domain\User\UserRepository;

class UsersServiceProvider
{
    public function __construct(private readonly Container $container)
    {
    }

    public function add(): void
    {
        $this->container->add(PostLoginUserController::class)->addArgument(PostLoginUserUseCase::class);
        $this->container->add(PostLoginUserUseCase::class)
            ->addArgument(UserRepository::class)
            ->addArgument(TokenRepository::class);
        // $this->container->add(UserRepository::class, UserRepositoryImpl::class)->addArgument(MySQLConnection::class);
        $this->container->add(TokenRepository::class);
    }
}