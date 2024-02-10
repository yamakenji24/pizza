<?php declare(strict_types=1);

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use GuzzleHttp\Psr7\Response;

class ApiPostController
{
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $request_body = json_decode($request->getBody()->getContents(), true);

        
        return new Response(200, [], 'API Post Request'.$request_body['name']);
    }
}
