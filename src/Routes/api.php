<?php declare(strict_types=1);

use App\Controller\ApiController;
use App\Controller\ApiPostController;
use App\Container\Container;
use App\Routes\Router;
use GuzzleHttp\Psr7\ServerRequest;

return function (): void {
    $request = ServerRequest::fromGlobals();
    
    $container = new Container();
    $router = new Router($container);

    $router->group('/api', function ($router) {
        $router->addRoute('GET', '/account', ApiController::class);
    });

    $router->addRoute('POST', '/api', ApiPostController::class);

    $response = $router->resolve($request);

    http_response_code($response->getStatusCode());
    echo $response->getBody();
};