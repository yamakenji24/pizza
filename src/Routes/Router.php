<?php declare(strict_types=1);

namespace App\Routes;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use GuzzleHttp\Psr7\Response;
use App\Container\Container;
use App\Container\ServiceProvider;

class Router
{
    /**
     * @var array<string, array<string, callable|string>>
     */
    private array $routes = [];
    private string $groupPrefix = '';

    public function __construct(private Container $container)
    {
        $this->addServiceProvider();
    }

    public function group(string $prefix, callable $callback): void {
        $currentGroupPrefix = $this->groupPrefix;
        $this->groupPrefix = $currentGroupPrefix . $prefix;
        $callback($this);
        $this->groupPrefix = $currentGroupPrefix;
    }

    public function addRoute(string $method, string $route, mixed $handler): void {
        $path = rtrim($this->groupPrefix . $route, '/');
        $this->routes[$method][$path] = $handler;
        $this->routes[$method][$path . '/'] = $handler;
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
        $serviceProvider = new ServiceProvider($this->container);
        $serviceProvider->register();
    }
}