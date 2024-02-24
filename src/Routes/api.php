<?php declare(strict_types=1);

use App\Container\Container;
use App\Controller\User\GetCurrentUserController;
use App\Controller\Users\PostLoginUserController;
use App\Routes\Router;
use GuzzleHttp\Psr7\ServerRequest;

return function (): void {
    $request = ServerRequest::fromGlobals();
    
    $container = new Container();
    $router = new Router($container);

    $router->group('/api/user', function ($router) {
        $router->addRoute('GET', '/', GetCurrentUserController::class);
    });

    $router->group('/api/users', function($router) {
        $router->addRoute('POST', '/login', PostLoginUserController::class);
    });

    $response = $router->resolve($request);

    http_response_code($response->getStatusCode());
    echo $response->getBody();
};