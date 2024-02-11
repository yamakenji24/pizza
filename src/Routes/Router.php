<?php declare(strict_types=1);

namespace App\Routes;

use App\Controller\ApiController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use GuzzleHttp\Psr7\Response;
use App\Container\Container;
use App\Application\Sample\SampleUseCase;

class Router
{
    /**
     * @var array<string, array<string, callable|string>>
     */
    private array $routes = [];

    public function __construct(private Container $container)
    {
        $this->addServiceProvider();
    }

    public function addRoute(string $method, string $route, mixed $handler): void {
        $this->routes[$method][$route] = $handler;
    }

    public function resolve(ServerRequestInterface $request): ResponseInterface {
        $method = $request->getMethod();
        $route = $request->getUri()->getPath();

        $handler = $this->routes[$method][$route] ?? null;

        if ($handler) {
            if (is_string($handler)) {
                $handler = $this->container->get($handler);
            }
            return $handler($request);
        } else {
            return new Response(404, [], 'Not found');
        }
    }

    private function addServiceProvider(): void {
        $this->container->add(ApiController::class)->addArgument(SampleUseCase::class);
        $this->container->add(SampleUseCase::class);
    }
}