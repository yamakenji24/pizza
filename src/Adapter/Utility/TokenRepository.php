<?php

namespace App\Adapter\Utility;

use Firebase\JWT\JWT;

class TokenRepository
{
    private $algorithm;

    public function __construct()
    {
        $this->algorithm = 'RS256';
    }

    public function generateToken(int $account_id): string
    {
        $payload = [
            'aud'         => 'http://pizza.local.com',
            'iss'         => 'http://pizza.local.com',
            'iat'         => time(),
            'sub'         => 'pizza|'.$account_id,
            'exp'         => time() + 60 * 60,
            'account_id'  => $account_id
        ];

        return JWT::encode($payload, file_get_contents(__DIR__.'/rsa/secret_key.pem'), $this->algorithm);
    }
}