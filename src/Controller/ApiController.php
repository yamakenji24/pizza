<?php declare(strict_types=1);

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;

class ApiController
{
    public function __invoke(): ResponseInterface
    {
        return new Response(200, [], 'APIのページですaaaaaaa');
    }
}
