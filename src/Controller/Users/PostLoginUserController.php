<?php declare(strict_types=1);

namespace App\Controller\Users;

use App\Application\Users\PostLoginUserUseCase;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class PostLoginUserController
{
    public function __construct(private readonly PostLoginUserUseCase $usecase)
    {
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $request_body = json_decode($request->getBody()->getContents(), true);
        $email = $request_body['email'];
        $password = $request_body['password'];

        $result = $this->usecase->execute($email, $password);

        return new Response(
            status: 200,
            headers: ['Content-Type' => 'application/json'],
            body: json_encode(['token' => $result])
        );
    }
}