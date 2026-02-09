<?php

namespace Domain\Account\UseCases\GetAccountBalance;

use App\Domain\Accounts\Exceptions\AccountNotFound;
use App\Domain\Accounts\UseCases\Balance\GetAccountBalanceUseCase;
use Tests\TestCase;

class GetAccountBalanceUseCaseTest extends TestCase
{
    private GetAccountBalanceUseCase $useCase;

    public function setUp(): void
    {
        $this->useCase = new GetAccountBalanceUseCase();
    }

    public function testGetAccountBalanceSuccess(): void
    {
        $validAccountId = 100;

        $balance = $this->useCase->execute($validAccountId);

        $expectedBalance = 20;

        $this->assertEquals($expectedBalance, $balance);
    }

    public function testGetAccountBalanceNotFound(): void
    {
        $this->expectException(AccountNotFound::class);

        $this->useCase->execute(999);
    }
}
