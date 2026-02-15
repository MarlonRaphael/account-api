<?php

namespace Tests\Unit\app\Account\Domain\UseCases\Events\Withdraw;

use App\Accounts\Domain\UseCases\Events\Transfer\TransferUseCase;
use App\Accounts\Domain\UseCases\Events\Withdraw\DTO\WithdrawBalanceInput;
use App\Accounts\Domain\UseCases\Events\Withdraw\DTO\WithdrawBalanceOutput;
use App\Accounts\Domain\UseCases\Events\Withdraw\WithdrawBalanceUseCase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class WithdrawUseCaseTest extends TestCase
{
    private WithdrawBalanceUseCase $useCase;

    public function setUp(): void
    {
        parent::setUp();
        $this->useCase = $this->createMock(WithdrawBalanceUseCase::class);
    }

    #[DataProvider('dataProviderWithdraw')]
    public function testWithdraw(
        WithdrawBalanceInput $input,
        WithdrawBalanceOutput $expected
    ): void
    {
        $this->useCase
            ->method('execute')
            ->with($input)
            ->willReturn($expected);

        $this->assertSame($expected, $this->useCase->execute($input));
    }

    public static function dataProviderWithdraw(): array
    {
        return [
            'testShouldBeErrorWhenOriginAccountDoesNotExists' => [
                'input' => new WithdrawBalanceInput(accountId: 999, amount: 10),
                'expected' => new WithdrawBalanceOutput(accountId: 999, amount: 10)
            ],
            'textShouldBeSuccessWhenWithdrawFromExistsAccount' => [
                'input' => new WithdrawBalanceInput(accountId: 100, amount: 20),
                'expected' => new WithdrawBalanceOutput(accountId: 100, amount: 0)
            ]
        ];
    }
}
