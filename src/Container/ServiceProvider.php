<?php declare(strict_types=1);

namespace App\Container;

use App\Container\Container;
use App\Controller\ApiController;
use App\Application\Sample\SampleUseCase;

class ServiceProvider
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function register(): void
    {
        $this->container->add(ApiController::class)->addArgument(SampleUseCase::class);
        $this->container->add(SampleUseCase::class);
    }
}