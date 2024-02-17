<?php declare(strict_types=1);

namespace App\Controller\User;

use App\Application\User\GetCurrentUserUseCase;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

class GetCurrentUserController
{
    public function __construct(private GetCurrentUserUseCase $usecase)
    {
    }

    public function __invoke(): ResponseInterface
    {
        // アクセストークンでユーザーを認証し、ユーザー情報を取得する処理を想定
        // トークンの検証はもっと上位のレイヤーで既に行われていると仮定
        // account_idはそこから取得できているとする
        $account_id = 1;
        $response = $this->usecase->execute($account_id);
        $data = [
            "user" => [
                "email" => $response->getEmail(),
                "token" => "jwt.token.here",
                "username" => $response->getUsername(),
                "bio" => $response->getBio(),
                "image" => $response->getImage()
            ]
        ];
        return new Response(200, ['Content-Type' => 'application/json'], json_encode($data, JSON_UNESCAPED_UNICODE));
    }
}