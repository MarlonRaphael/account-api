<?php

namespace Tests\Unit\app\Account\Domain\UseCases\Balance;

use App\Accounts\Domain\Exceptions\AccountNotFound;
use App\Accounts\Domain\Repositories\AccountRepository;
use App\Accounts\Domain\UseCases\Balance\DTO\GetBalanceInput;
use App\Accounts\Domain\UseCases\Balance\GetBalanceUseCase;
use Tests\TestCase;

class GetBalanceUseCaseTest extends TestCase
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
