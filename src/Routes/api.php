<?php declare(strict_types=1);

use App\Controller\ApiController;
use App\Routes\Router;
use GuzzleHttp\Psr7\ServerRequest;

return function (): void {
    $request = ServerRequest::fromGlobals();

    $router = new Router();

    $router->addRoute('GET', '/api', function($request) {
        $controller = new ApiController();
        return $controller($request);
    });

    $response = $router->resolve($request);

    http_response_code($response->getStatusCode());
    echo $response->getBody();
};