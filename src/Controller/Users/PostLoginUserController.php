<?php declare(strict_types=1);

namespace App\Controller\Users;

use App\Application\Users\PostLoginUserUseCase;
use App\Domain\User\InvalidUserAuthenticateException;
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
        $email = $request_body['email'] ?? null;
        $password = $request_body['password'] ?? null;

        if (is_null($email) || is_null($password)) {
            return new Response(
                status: 400,
                headers: ['Content-Type' => 'application/json'],
                body: json_encode(['error' => 'Invalid email or password'])
            );
        }

        try {
            $result = $this->usecase->execute($email, $password);

            return new Response(
                status: 200,
                headers: ['Content-Type' => 'application/json'],
                body: json_encode([
                    'email' => $result['email'],
                    'username' => $result['username'],
                    'bio' => $result['bio'],
                    'image' => $result['image'],
                    'token' => $result['token']
                ])
            );
        } catch(InvalidUserAuthenticateException) {
            return new Response(
                status: 401,
                headers: ['Content-Type' => 'application/json'],
                body: json_encode(['error' => 'Invalid email or password'])
            );
        } catch(\Exception) {
            return new Response(
                status: 500,
                headers: ['Content-Type' => 'application/json'],
                body: json_encode(['error' => 'Internal Server Error'])
            );
        }
    }
}