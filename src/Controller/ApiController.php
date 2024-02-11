<?php declare(strict_types=1);

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use GuzzleHttp\Psr7\Response;
use App\Application\Sample\SampleUseCase;

class ApiController
{
    public function __construct(private SampleUseCase $usecase)
    {
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $result = $this->usecase->execute();
        return new Response(200, [], 'APIのページです'.$result);
    }
}
