<?php declare(strict_types=1);

namespace App\Routes;

class Router
{
    private array $routes = [];
    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function addRoute(string $pattern, callable $callback): void
    {
        $this->routes[$pattern] = $callback;
    }

    public function resolve(): void
    {
        foreach ($this->routes as $pattern => $callback) {
            if ($pattern === $this->path) {
                call_user_func($callback);
                return;
            }
        }

        $this->handleNotFound();
    }

    private function handleNotFound(): void
    {
        // ページが見つからなかった場合の処理を記述
        echo 'ページが見つかりません';
    }
}