<?php declare(strict_types=1);

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use GuzzleHttp\Psr7\Response;

class ApiController
{
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        return new Response(200, [], 'APIのページです');
    }
}
