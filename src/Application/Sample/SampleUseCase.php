<?php declare(strict_types=1);

namespace App\Application\Sample;

use App\Adapter\Account\AccountRepositoryImpl;

class SampleUseCase
{
    public function __construct(private AccountRepositoryImpl $accountRepositoryImpl) {}

    public function execute(): string
    {
        try {
            $account = $this->accountRepositoryImpl->findById(1);
        } catch(\Exception $e) {
            return $e->getMessage();
        }
        return 'Hello World';
    }
}
