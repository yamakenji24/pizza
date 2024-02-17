<?php declare(strict_types=1);

namespace App\Container;

use App\Adapter\Account\AccountRepositoryImpl;
use App\Adapter\Infrastructure\MySQLConnection;
use App\Container\Container;
use App\Container\Services\UserServiceProvider;
use App\Controller\ApiController;
use App\Application\Sample\SampleUseCase;

class ServiceProvider
{
    public function __construct(private Container $container)
    {
    }

    public function register(): void
    {
        (new UserServiceProvider($this->container))->add();

        $this->container->add(ApiController::class)->addArgument(SampleUseCase::class);
        
        // ここはInterfaceを使うべき
        $this->container->add(SampleUseCase::class)->addArgument(AccountRepositoryImpl::class);
        $this->container->add(AccountRepositoryImpl::class)->addArgument(MySQLConnection::class);
        $this->container->add(MySQLConnection::class);
    }
}