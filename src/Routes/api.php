<?php declare(strict_types=1);

use App\Router\Router;

return function (string $path): void {
    $router = new Router($path);

    $router->addRoute('/api', function () {
        echo 'APIのページです';
    });

    $router->addRoute('/api/users', function () {
        echo 'ユーザー一覧のページです';
    });

    $router->addRoute('/api/users/1', function () {
        echo 'ユーザー詳細のページです';
    });

    $router->resolve();
};