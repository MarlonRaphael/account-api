<?php

namespace Domain\Account\UseCases\GetAccountBalance;

use App\Domain\Accounts\Exceptions\AccountNotFound;
use App\Domain\Accounts\Repositories\AccountRepository;
use App\Domain\Accounts\UseCases\Balance\DTO\GetBalanceInput;
use App\Domain\Accounts\UseCases\Balance\GetBalanceUseCase;
use App\Persistence\Account\Repositories\InMemoryAccountRepository;
use Tests\TestCase;

class GetAccountBalanceUseCaseTest extends TestCase
{
    private GetBalanceUseCase $useCase;

    public function setUp(): void
    {
        parent::setUp();
        $this->useCase = new GetBalanceUseCase();
    }

    public function testGetAccountBalanceSuccess(): void
    {
        $input = new GetBalanceInput(accountId: 100);

        $repository = $this->createMock(AccountRepository::class);
        $repository->method('getBalance')->willReturn(20);

        $output = $this->useCase->execute($input, $repository);

        $expectedBalance = 20;

        $this->assertEquals($expectedBalance, $output->balance);
    }

    public function testGetAccountBalanceNotFound(): void
    {
        $this->expectException(AccountNotFound::class);

        $input = new GetBalanceInput(999);

        $repository = $this->createMock(AccountRepository::class);
        $repository->method('getBalance')->willReturn(0);

        $this->useCase->execute($input, $repository);
    }
}
