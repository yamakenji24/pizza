<?php declare(strict_types=1);

namespace App\Routes;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use GuzzleHttp\Psr7\Response;

class Router
{
    private array $routes = [];

    public function __construct()
    {
    }

    public function addRoute(string $method, string $route, mixed $handler): void {
        // Store the route handler for the given method and route
        $this->routes[$method][$route] = $handler;
    }

    public function resolve(ServerRequestInterface $request): ResponseInterface {
        $method = $request->getMethod();
        $route = $request->getUri()->getPath();
        // Find the handler for the current method and route
        $handler = $this->routes[$method][$route] ?? null;

        if ($handler) {
            if (is_string($handler) && class_exists($handler)) {
                $class = new $handler();
                return $class($request);
            } else {
                return $handler($request);
            }
        } else {
            return new Response(404, [], 'Not found');
        }
    }
}