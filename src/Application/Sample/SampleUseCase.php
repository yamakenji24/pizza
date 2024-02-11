<?php declare(strict_types=1);

namespace App\Application\Sample;

class SampleUseCase
{
    public function __construct() {}

    public function execute(): string
    {
        return 'Hello World';
    }
}
