<?php declare(strict_types=1);

namespace App\Container\Services;

use App\Adapter\Infrastructure\MySQLConnection;
use App\Adapter\User\UserRepositoryImpl;
use App\Application\User\GetCurrentUserUseCase;
use App\Container\Container;
use App\Controller\User\GetCurrentUserController;
use App\Domain\User\UserRepository;

class UserServiceProvider
{
    public function __construct(private Container $container)
    {
    }

    public function add(): void
    {
        $this->container->add(GetCurrentUserController::class)->addArgument(GetCurrentUserUseCase::class);
        $this->container->add(GetCurrentUserUseCase::class)->addArgument(UserRepository::class);
        $this->container->add(UserRepository::class, UserRepositoryImpl::class)->addArgument(MySQLConnection::class);
    }
}