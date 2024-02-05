<?php declare(strict_types=1);

namespace App\Controller;

class ApiController
{
    public function __invoke(): void
    {
        echo 'APIのページですa';
    }
}
