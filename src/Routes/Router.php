<?php declare(strict_types=1);

namespace App\Routes;

class Router
{
    private array $routes = [];

    public function __construct(private string $method, private string $route)
    {
    }

    public function addRoute(string $method, string $route, mixed $handler): void {
        // Store the route handler for the given method and route
        $this->routes[$method][$route] = $handler;
    }

    public function resolve(): void {
        // Find the handler for the current method and route
        $handler = $this->routes[$this->method][$this->route] ?? null;

        if ($handler) {
            if (is_string($handler) && class_exists($handler)) {
                $handler = new $handler();
            }
            if (is_callable($handler)) {
                call_user_func($handler);
            } else {
                throw new \Exception("Handler is not callable");
            }
        } else {
            // No handler found for the current method and route
            http_response_code(404);
            echo "Not found";
        }
    }
}