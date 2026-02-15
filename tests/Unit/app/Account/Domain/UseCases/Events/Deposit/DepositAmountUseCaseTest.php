<?php

namespace Tests\Unit\app\Account\Domain\UseCases\Events\Deposit;

use App\Accounts\Domain\Repositories\AccountRepository;
use App\Accounts\Domain\UseCases\Events\Deposit\DepositAmountUseCase;
use App\Accounts\Domain\UseCases\Events\Deposit\DTO\DepositAmountInput;
use App\Accounts\Domain\UseCases\Events\Deposit\DTO\DepositAmountOutput;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class DepositAmountUseCaseTest extends TestCase
{
    private DepositAmountUseCase $useCase;
    private AccountRepository $accountRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->useCase = $this->createMock(DepositAmountUseCase::class);
        $this->accountRepository = $this->createMock(AccountRepository::class);
    }

    #[DataProvider('dataProvider')]
    public function testDepositAmount(
        DepositAmountInput $input,
        DepositAmountOutput $expected
    ): void {
        $this->useCase
            ->method('execute')
            ->with($input, $this->accountRepository)
            ->willReturn($expected);

        $this->assertSame($expected, $this->useCase->execute($input, $this->accountRepository));
    }

    public static function dataProvider(): array
    {
        return [
            'testShouldBeErrorWhenDestinationAccountDoesNotExists' => [
                'input' => new DepositAmountInput(destination: 999, amount: 10),
                'expected' => new DepositAmountOutput(999, 10)
            ],
            'textShouldBeSuccessWhenDepositInExistsAccount' => [
                'input' => new DepositAmountInput(destination: 100, amount: 20),
                'expected' => new DepositAmountOutput(100, 20)
            ]
        ];
    }
}
