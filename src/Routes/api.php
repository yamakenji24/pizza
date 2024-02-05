<?php declare(strict_types=1);

use App\Controller\ApiController;
use App\Routes\Router;


return function (string $path, string $method): void {
    $router = new Router($path, $method);

    $router->addRoute('GET', '/api', ApiController::class);

    $router->resolve();
};